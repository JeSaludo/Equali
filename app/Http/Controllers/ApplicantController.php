<?php

namespace App\Http\Controllers;

use App\Mail\AcceptanceMail;
use App\Mail\ScheduleMail;
use App\Mail\RejectMail;
use App\Models\AdmissionExam;
use App\Models\QualifiedStudent;
use App\Models\Result;
use App\Models\Option;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Jobs\SendScheduleEmail;
use App\Jobs\SendAcceptanceEmail;
use App\Jobs\SendProctorMail;
use App\Mail\NotifyProctor;
class ApplicantController extends Controller
{
    

    function ShowApplicant(Request $request){
        

        if(auth()->user()->role === "ProgramHead"){
            $users  = User::where('role', 'Student')->with('admissionExam')->where('status', 'Pending')
            ->orWhere('status', 'Ready For Exam')
            ->orWhere('status', 'Pending Schedule');

        }
            
        $searchTerm = $request->searchTerm;
        
        $recentUser = User::where('role', 'Student')->get();
        
        if(isset($searchTerm)){
            
           
            $users->where('first_name', 'like', "%$searchTerm%")
                ->orWhere('last_name', 'like', "%$searchTerm%");
        }

        $users = $users->paginate(10);
        return view('admin.dashboard-view-applicant', compact('users', 'recentUser'));

    }

    function StoreApplicant(Request $request){

        try{           
            $request->validate([
                'firstName' => 'required',   
                'lastName' => 'required',          
                'email' => 'required|email:rfc,dns|unique:users,email',  
                'rawScore' => 'required'
                // 'contactNumber' => 'required|min:11|unique:users,contact_number|numeric',
               
            ]);
            DB::beginTransaction();
                
            $user = new User();
            $user->first_name = $request->firstName;
            $user->last_name = $request->lastName;
            $user->email = $request->email;
            $user->contact_number = $request->contactNumber;         
            $user->status = "Pending Schedule";
            $user->save();

            $tempPassword = $user->last_name . $user->first_name . "12345";
            $tempPassword = preg_replace('/\s+/u', '', $tempPassword);
            $tempPassword = strtolower($tempPassword);
            $user->password = $tempPassword;
            $user->save();

            $admissionExam = new AdmissionExam();
            $admissionExam->user_id = $user->id;
            $admissionExam->raw_score = $request->rawScore;
            
            
            if($request->percentage > 74){
                $admissionExam->status = "Passed";
            }
            else{
                $admissionExam->status = "Failed";
            }
            
            $admissionExam->percentage = $request->percentage;
            $admissionExam->save();
            
            $score = $request->score;

            $result = new Result();
            $result->user_id = $user->id;            
           

            $result->measure_b_score = $request->measure_b_score;
           
    
            $result->save();

            $approveUser = new QualifiedStudent();
            $approveUser->user_id = $user->id;
            $approveUser->save();
            $tempPassword = $user->last_name . $user->first_name . "12345";
            $tempPassword = preg_replace('/\s+/u', '', $tempPassword);
            $tempPassword = strtolower($tempPassword);
            Mail::to($user->email)->send(new AcceptanceMail($user->email, $user->first_name,  $user->last_name, $tempPassword));           
            
            //dispatch(new SendAcceptanceEmail($user->email, $user->first_name, $user->last_name, $tempPassword));
           
    
            DB::commit();
          
           
        }
        catch (\Exception $e) {        
            DB::rollback(); 
            return redirect()->back()->with('error', 'Failed to add the applicant. Please try again .' . $e->getMessage());
        }
       
      return redirect()->back()->with('success', 'Applicant added successfully!');       
       
    }

    function EditApplicant($id){       

        $user = User::where('role', 'Student')->with('admissionExam')->findOrFail($id);
        
        return view('admin.dashboard-edit-applicant', compact('user'));
    }

    function UpdateApplicant(Request $request,$id){
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email,' . $id, 
            // 'contactNumber' => 'required|min:11|unique:users,contact_number,' . $id, 
        ]);
        
        $user = User::where('role', 'Student')->with('admissionExam')->findOrFail($id);
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->email = $request->email;
        $user->contact_number = $request->contactNumber;           
        

        $user->admissionExam->raw_score = $request->rawScore;        
    
        $user->admissionExam->percentage = $request->percentage;        
    
        
        if($request->percentage >= 74){
            $user->admissionExam->status = "Passed";
        }
        else{
            $user->admissionExam->status = "Failed";
        }
        $user->admissionExam->save();
        $user->save();

        $result = Result::where('user_id', $user->id)->first();
       
        
        $result->measure_b_score = $request->measure_b_score;    


       
        $result->save();
       
        return redirect()->route('admin.dashboard.admission')->with('success', 'User has been updated successfully');       
    }
    
    function ApproveApplicant($id){
        $user = User::where('role', 'Student')->findOrFail($id);
        $user->status = "Pending Schedule";
        $user->save();

        $approveUser = new QualifiedStudent();
        $approveUser->user_id = $user->id;
        $approveUser->save();
        $tempPassword = $user->last_name . $user->first_name . "12345";
        $tempPassword = preg_replace('/\s+/u', '', $tempPassword);
        $tempPassword = strtolower($tempPassword);
        //Mail::to($user->email)->send(new AcceptanceMail($user->email, $user->first_name,  $user->last_name, $tempPassword));           
        
       dispatch(new SendAcceptanceEmail($user->email, $user->first_name, $user->last_name, $tempPassword));
       return redirect()->back()->with('success', 'Approved Applicant successfully!');       
        
    }

    function ApproveApplicantMultiple(Request $request){
        $selectedUserIds = $request->input('selectedUsers');
                
        if(isset($selectedUserIds) == null){
            return redirect()->back();   
        }
        foreach ($selectedUserIds as $userId) {
        
            $user = User::where('role', 'Student')->findOrFail($userId);
            $user->status = "Pending Schedule";
            $user->save();
    
            $approveUser = new QualifiedStudent();
            $approveUser->user_id = $user->id;
            $approveUser->save();
            $tempPassword = $user->last_name . $user->first_name . "12345";
            $tempPassword = preg_replace('/\s+/u', '', $tempPassword);
            $tempPassword = strtolower($tempPassword);
            //Mail::to($user->email)->send(new AcceptanceMail($user->email, $user->first_name,  $user->last_name, $tempPassword));           
            dispatch(new SendAcceptanceEmail($user->email, $user->first_name, $user->last_name, $tempPassword));
            
        }
        return redirect()->back()->with('success', 'Approved Applicant successfully!');       
       

    }
    function ArchiveApplicant($id){
       
        $user = User::where('role', 'Student')->findOrFail($id);
        $user->status = "Archived";
        $user->save();      
        return redirect()->back()->with('success', 'Archive Applicant successfully!');       
    }
    function ArchiveApplicantWithEmail($id){
        
        $user = User::where('role', 'Student')->findOrFail($id);
        $user->status = "Archived";
        $user->save();      
        Mail::to($user->email)->send(new RejectMail($user->first_name,  $user->last_name));           
          
        return redirect()->back()->with('success', 'Archive Applicant successfully!');       
    }

    function UnqualifyApplicant($id){
        $user = User::where('role', 'Student')->findOrFail($id);
        $user->status = "Unqualified";
        $user->save();      
        return redirect()->back()->with('success', 'Unqualify Applicant successfully!');       
    }

    function QualifyApplicant($id){
        $user = User::where('role', 'Student')->findOrFail($id);
        $user->status = "Qualified";
        $user->save();      
        return redirect()->back()->with('success', 'Qualify Applicant successfully!');       
    }


    function DeleteApplicant($id){
        $user = User::where('role', 'Student')->with('admissionExam')->findOrFail($id);
        $user->admissionExam->delete();
        $user->delete();
        
        return redirect()->back()->with('success', 'Applicant deleted successfully!');       
    }

    function ShowApprovedApplicant(Request $request){

        $users = User::where('role', 'Student')->with('admissionExam')
        ->where('status', 'Pending Interview')
        ->Orwhere('status', 'Pending Schedule')
        ->orWhere('status','Ready For Exam');
        //->doesntHave('studentInfo');
        // ->with('qualifiedStudent')->get();
        $searchTerm = $request->searchTerm;
        
        $recentUser = User::where('role', 'Student')->get();
        
        if(isset($searchTerm)){            
           
            $users->where('first_name', 'like', "%$searchTerm%")
                ->orWhere('last_name', 'like', "%$searchTerm%");
        
        }
        $users = $users->paginate(10);
        return view('admin.dashboard-view-approve-applicant', compact('users','recentUser'));
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

    

    // function Schedule(Request $request){

        

    //     $option = Option::first();

       
    //     $validate = $request->validate([
    //         'date' => 'required',
    //         'selectedUsers' => 'required|array|min:1',
    //         'start_time' => 'required',
    //         'location' => 'required',
        
    //     ]);
        
    //     $selectedUserIds = $request->input('selectedUsers');
       
    //     foreach ($selectedUserIds as $userId) {
    //        $user = QualifiedStudent::where('user_id', $userId)->with('user')->first();

    //        $user->exam_schedule_date = $request->date;
    //        $user->start_time = $request->start_time;
    //        $user->location = $request->location;
           
    //        $user->save();

    //        $temp_user = User::find($userId);
    //        $temp_user->status = "Pending Interview";
    //        $temp_user->save();
    //        dispatch(new SendScheduleEmail($user->user->email, $user->exam_schedule_date, $user->start_time, $user->first_name, $user->last_name, $user->location));
    //        //Mail::to($user->user->email)->send(new ScheduleMail($user->exam_schedule_date, $user->start_time, $temp_user->first_name, $temp_user->last_name, $user->location));
    //        //
          
    //     }
          
        
    //     //     //dispatch(new SendProctorMail($proctor->email, $proctor->last_name, $proctor->first_name, $user->last_name, $user->first_name, $user->exam_schedule_date, $user->start_time));
        
    //     //change this to proper mail tomorrow
    //     $proctors = User::where('role', 'Proctor')->get();
    //     foreach ($proctors as $proctor) {
    //         Mail::to($proctor->email)->send(new NotifyProctor());
    //     }
        

    
         
    //     return redirect()->route('admin.dashboard.show-schedule-interview');
       
        
    // }

    //Schedule
 
    function Schedule(Request $request){

        $option = Option::first();
    
        // Validate the request
        $validate = $request->validate([
            'date' => 'required',
            'selectedUsers' => 'required|array|min:1',
            'start_time' => 'required',
            'location' => 'required',
        ]);
    
        // Get the selected user IDs
        $selectedUserIds = $request->input('selectedUsers');
    
        // Loop through each selected user
        foreach ($selectedUserIds as $userId) {
            $user = QualifiedStudent::where('user_id', $userId)->with('user')->first();
    
            // Check if scheduling limit for the date has been reached
            $scheduleCountForDate = QualifiedStudent::where('exam_schedule_date', $request->date)->count();
            if ($scheduleCountForDate > $option->slot_per_day )  {
                // Limit reached, handle accordingly (e.g., show an error message)
                return redirect()->back()->withErrors(['date' => 'Scheduling limit for this date has been reached.']);
            }
            else{
            // Update user's schedule
            $user->exam_schedule_date = $request->date;
            $user->start_time = $request->start_time;
            $user->location = $request->location;
            $user->save();

            // Update user status
            $temp_user = User::find($userId);
            $temp_user->status = "Pending Interview";
            $temp_user->save();

            // Dispatch email notification
            dispatch(new SendScheduleEmail($user->user->email, $user->exam_schedule_date, $user->start_time, $user->first_name, $user->last_name, $user->location));

            }
    
           }
    
        // Notify proctors
        $proctors = User::where('role', 'Proctor')->get();
        foreach ($proctors as $proctor) {
            Mail::to($proctor->email)->send(new NotifyProctor());
        }
    
        return redirect()->route('admin.dashboard.show-schedule-interview')->with("success",'Schedule added successfuly');
    }
    


    function ReSchedule($id){
      
        $user = User::find($id);
        $user->status = "Pending Schedule";
        $user->save();
        $temp_user = QualifiedStudent::where('user_id', $user->id)->with('user')->first();
        $temp_user->exam_schedule_date = null;
        $temp_user->start_time = null;
        $temp_user->location = null;
        $temp_user->save();
       
        return redirect()->route('admin.dashboard.show-schedule-interview')->with("success",'Reschedule added successfuly');
   
    }

    function ShowArchiveApplicant(Request $request){

        $users = User::where('role', 'Student')->with('admissionExam')->where('Status', 'Archived');
       
        $searchTerm = $request->searchTerm;
        
        $recentUser = User::where('role', 'Student')->get();
        
        if(isset($searchTerm)){            
           
            $users->where('first_name', 'like', "%$searchTerm%")
                ->orWhere('last_name', 'like', "%$searchTerm%");
        
        }
        $users = $users->paginate(10);
        
        return view('admin.dashboard-view-archive-applicant', compact('users', 'recentUser'));
    }

    function ShowPendingApplicant(Request $request){


        
        $users = User::where('role', 'Student')->with('admissionExam')->where('Status', 'Pending');
       
        $searchTerm = $request->searchTerm;
        
        $recentUser = User::where('role', 'Student')->get();
        
        if(isset($searchTerm)){                       
            $users->where('first_name', 'like', "%$searchTerm%")
                ->orWhere('last_name', 'like', "%$searchTerm%");        
        }        
        $users = $users->paginate(10);
        return view('admin.dashboard-view-pending-applicant', compact('users', 'recentUser'));
    }

    function ShowWaitListedApplicant(Request $request){
        $users = User::where('role', 'Student')->with('admissionExam')->where('Status', 'WaitListed');
       
        $searchTerm = $request->searchTerm;
        
        $recentUser = User::where('role', 'Student')->get();
        
        if(isset($searchTerm)){                       
            $users->where('first_name', 'like', "%$searchTerm%")
                ->orWhere('last_name', 'like', "%$searchTerm%");        
        }        
        $users = $users->paginate(10);
        return view('admin.dashboard-view-waitlisted-applicant', compact('users', 'recentUser'));
    }

    function ShowQualifiedApplicant(Request $request){
        $users = User::where('role', 'Student')->with('admissionExam')->where('Status', 'Qualified');
       
        $searchTerm = $request->searchTerm;
        
        $recentUser = User::where('role', 'Student')->get();
        
        if(isset($searchTerm)){                       
            $users->where('first_name', 'like', "%$searchTerm%")
                ->orWhere('last_name', 'like', "%$searchTerm%");        
        }        
        $users = $users->paginate(10);
        return view('admin.dashboard-view-qualified-applicant', compact('users', 'recentUser'));
    }

    function ShowUnqualifiedApplicant(Request $request){
        $users = User::where('role', 'Student')->with('admissionExam')->where('Status', 'Unqualified');
       
        $searchTerm = $request->searchTerm;
        
        $recentUser = User::where('role', 'Student')->get();
        
        if(isset($searchTerm)){                       
            $users->where('first_name', 'like', "%$searchTerm%")
                ->orWhere('last_name', 'like', "%$searchTerm%");        
        }        
        $users = $users->paginate(10);
        return view('admin.dashboard-view-unqualified-applicant', compact('users', 'recentUser'));
    }
   
}
