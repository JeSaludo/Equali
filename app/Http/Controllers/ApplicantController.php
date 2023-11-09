<?php

namespace App\Http\Controllers;

use App\Mail\AcceptanceMail;
use App\Mail\ScheduleMail;
use App\Models\AdmissionExam;
use App\Models\QualifiedStudent;
use App\Models\Result;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class ApplicantController extends Controller
{
    

    function ShowApplicant(){
        $users  = User::where('role', 'Student')->where('status', 'Pending')->with('admissionExam')->paginate(10);

        return view('admin.dashboard-view-applicant', compact('users'));

    }

    function StoreApplicant(Request $request){
        try{           
            $request->validate([
                'firstName' => 'required',   
                'lastName' => 'required',          
                'email' => 'required|email|unique:users,email',  
                // 'contactNumber' => 'required|min:11|unique:users,contact_number|numeric',
               
            ]);
            
            DB::beginTransaction();
                
            $user = new User();
            $user->first_name = $request->firstName;
            $user->last_name = $request->lastName;
            $user->email = $request->email;
            $user->contact_number = $request->contactNumber;         
            $user->status = "Pending";
            $user->save();

            $tempPassword = $user->last_name . $user->first_name . "12345";
            $tempPassword = preg_replace('/\s+/u', '', $tempPassword);
            $tempPassword = strtolower($tempPassword);
            $user->password = $tempPassword;
            


            $user->save();

            $admissionExam = new AdmissionExam();
            $admissionExam->user_id = $user->id;
            $admissionExam->score = $request->score;
            
            $passingPercentage =40;

            $passingScore = ($passingPercentage / 100) * $request->totalScore;
    
            if($request->score >= $passingScore){
                $admissionExam->status = "Passed";
            }
            else{
                $admissionExam->status = "Failed";
            }
            

            
            $admissionExam->total_score = $request->totalScore;
            $admissionExam->save();
            
            $score = $request->score;

            $result = new Result();
            $result->user_id = $user->id;            
            $minScore = 0;    
            $maxScore = $user->admissionExam->total_score; 
            $minValue = 1;    
            $maxValue = 5;  

            $score = min(max($score, $minScore), $maxScore);        
            
            $range = $maxValue - $minValue;
            $scoreFraction = ($score - $minScore) / ($maxScore - $minScore);
            $scaledValue = $minValue + $range * $scoreFraction;
            $scaledValue = intval($scaledValue);

            $result->measure_b_score = $scaledValue;
           
    
            $result->save();
    
            DB::commit();
          
           
        }
        catch (\Exception $e) {        
            DB::rollback(); 
            return redirect()->back()->with('error', 'Failed to add the applicant. Please try again later.');
        }
       
      return redirect()->back()->with('success', 'Question added successfully!');       
       
    }

    function EditApplicant($id){       

        $user = User::where('role', 'Student')->with('admissionExam')->findOrFail($id);
        
        return view('admin.dashboard-edit-applicant', compact('user'));
    }

    function UpdateApplicant(Request $request,$id){
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users,email,' . $id, 
            // 'contactNumber' => 'required|min:11|unique:users,contact_number,' . $id, 
        ]);
        
        $user = User::where('role', 'Student')->with('admissionExam')->findOrFail($id);
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->email = $request->email;
        $user->contact_number = $request->contactNumber;           
        

        $user->admissionExam->score = $request->score;        
        $passingPercentage =40;

        $passingScore = ($passingPercentage / 100) * $user->admissionExam->total_score;
        if($request->score >= $passingScore){
            $user->admissionExam->status = "Passed";
        }
        else{
            $user->admissionExam->status = "Failed";
        }
        $user->admissionExam->save();
        $user->save();

        $result = new Result();
        $result->user_id = $user->id;          

        $score= $user->admissionExam->score;

        $minScore = 0;    // Minimum score
        $maxScore = $user->admissionExam->total_score;  // Maximum score
        $minValue = 1;    // Minimum value
        $maxValue = 5;  

        $score = min(max($score, $minScore), $maxScore);        
        
        $range = $maxValue - $minValue;
        $scoreFraction = ($score - $minScore) / ($maxScore - $minScore);
        $scaledValue = $minValue + $range * $scoreFraction;
        $scaledValue = intval($scaledValue);
        $result->measure_b_score = $scaledValue;
      


       
        $result->save();
       
        return redirect()->route('admin.dashboard.show-applicant');       
    }
    
    function ApproveApplicant($id){
        $user = User::where('role', 'Student')->findOrFail($id);
        $user->status = "Approved";
        $user->save();

        $approveUser = new QualifiedStudent();
        $approveUser->user_id = $user->id;
        $approveUser->save();
        $tempPassword = $user->last_name . $user->first_name . "12345";
        $tempPassword = preg_replace('/\s+/u', '', $tempPassword);
        $tempPassword = strtolower($tempPassword);
        Mail::to($user->email)->send(new AcceptanceMail($user->email, $user->first_name,  $user->last_name, $tempPassword));           
        return redirect()->back()->with('success', 'Approved Applicant successfully!');       
        
    }

    function DeleteApplicant($id){
        $user = User::where('role', 'Student')->with('admissionExam')->findOrFail($id);
        $user->admissionExam->delete();
        $user->delete();
        
        return redirect()->back()->with('success', 'Applicant deleted successfully!');       
    }

    function ShowQualifiedApplicant(){
        $users = User::where('role', 'Student')->where('status', 'Approved')->with('qualifiedStudent')->get();
        return view('admin.dashboard-view-qualified-applicant', compact('users'));
    }   

    function EditQualifiedApplicant($id){

        $user = User::where('role', 'Student')->with('qualifiedStudent')->findOrFail($id);
        
        return view('admin.dashboard-edit-qualified-applicant', compact('user'));
    }

    function UpdateQualifiedApplicant(Request $request, $id){
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users,email,' . $id, 
           
        ]);
        
        $user = User::where('role', 'Student')->with('qualifiedStudent')->findOrFail($id);
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->email = $request->email;         
        $user->status = $request->status;       
        $user->save();
        // $user->qualifiedStudent->exam_schedule_date = $request->date;
        // $user->qualifiedStudent->start_time = $request->start_time;
        // $user->qualifiedStudent->end_time = $request->end_time;
        // $user->qualifiedStudent->save();
       
       
        return redirect()->route('admin.dashboard.show-qualified-appplicant');       
    }

    function StoreQualifiedApplicant(){

    }

    function DeleteQualifiedApplicant(){
        
    }


    function Schedule(Request $request){
        $validate = $request->validate([
            'date' => 'required',
            'selectedUsers' => 'required|array|min:1',
            'start_time' => 'required',
            'end_time' => 'required',
        
        ]);


        $selectedUserIds = $request->input('selectedUsers');

        foreach ($selectedUserIds as $userId) {
           $user = QualifiedStudent::where('user_id', $userId)->with('user')->first();

           $user->exam_schedule_date = $request->date;
           $user->start_time = $request->start_time;
           $user->end_time = $request->end_time;
           $user->save();                   
      
           Mail::to($user->user->email)->send(new ScheduleMail($user->exam_schedule_date, $user->start_time, $user->end_time));
        }

      
        
        return redirect()->route('admin.dashboard.show-qualified-appplicant');
       
        
    }

    function ShowApprovedApplicant(){
        $users = User::where('role', 'Student')->where('status', 'Approved')->with('qualifiedStudent')->get();
        return view('admin.dashboard-view-approve-applicant', compact('users'));
    } 
}
