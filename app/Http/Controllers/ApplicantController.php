<?php

namespace App\Http\Controllers;

use App\Mail\AcceptanceMail;
use App\Models\AdmissionExam;
use App\Models\QualifiedStudent;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;

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
                'contactNumber' => 'required|min:11|unique:users,contact_number|numeric',
               
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
            $user->password = $tempPassword;
            $user->save();

            $admissionExam = new AdmissionExam();
            $admissionExam->user_id = $user->id;
            $admissionExam->score = $request->score;
            
            $passingScore = 30;
    
            if($request->score >= $passingScore){
                $admissionExam->status = "Passed";
            }
            else{
                $admissionExam->status = "Failed";
            }
    
            $admissionExam->total_score = $request->totalScore;
            $admissionExam->save();
    
    
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
            'contactNumber' => 'required|min:11|unique:users,contact_number,' . $id, 
        ]);
        
        $user = User::where('role', 'Student')->with('admissionExam')->findOrFail($id);
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->email = $request->email;
        $user->contact_number = $request->contactNumber;           
        

        $user->admissionExam->score = $request->score;        
        $passingScore = 30;
        if($request->score >= $passingScore){
            $user->admissionExam->status = "Passed";
        }
        else{
            $user->admissionExam->status = "Failed";
        }
        $user->admissionExam->save();
        $user->save();
       
       
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
        Mail::to($user->email)->send(new AcceptanceMail($user->email, $user->first_name,  $user->last_name, $tempPassword));           
        return redirect()->back()->with('success', 'Approved Applicant successfully!');       
        
    }

    function DeleteApplicant($id){
        $user = User::where('role', 'Student')->with('admissionExam')->findOrFail($id);
        $user->admissionExam->delete();
        $user->delete();
        
        return redirect()->back()->with('success', 'Question added successfully!');       
    }

    function ShowAcceptedApplicant(){
        $users = User::where('role', 'Student')->where('status', 'Approved')->with('qualifiedStudent')->get();
        return view('admin.dashboard-view-accepted-applicant', compact('users'));
    }   

    function EditAcceptedApplicant(){
        
    }

    function StoreAcceptedApplicant(){

    }

    function DeleteAcceptedApplicant(){
        
    }
}
