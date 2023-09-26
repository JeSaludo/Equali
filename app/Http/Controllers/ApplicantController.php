<?php

namespace App\Http\Controllers;

use App\Models\AdmissionExam;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ApplicantController extends Controller
{
    

    function ShowApplicant(){
        $users  = User::where('role', 'User')->with('admissionExam')->paginate(10);

        return view('admin.dashboard-view-applicant', compact('users'));

    }

    function StoreApplicant(Request $request){

        $request->validate([
            'firstName' => 'required',   
            'lastName' => 'required',          
            'email' => 'required|email|unique:users,email',  
            'contactNumber' => 'required|min:11|unique:users,contact_number|numeric',
           
        ]);
        
      
            // Your database operations within the transaction
        $user = new User();
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->email = $request->email;
        $user->contact_number = $request->contactNumber;
        $user->password = 'student';
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
          
       return redirect()->back()->with('success', 'Question added successfully!');       
       
    }



    function EditApplicant($id){       

        $user = User::where('role', 'User')->with('admissionExam')->findOrFail($id);
        
        return view('admin.dashboard-edit-applicant', compact('user'));
    }

    function UpdateApplicant(Request $request,$id){
        $request->validate([
            'firstName' => 'required',   
            'lastName' => 'required',          
            'email' => [
                'required',
                'email',
                 Rule::unique('users', 'email')->ignore($id),
            ],
            'contactNumber' => [
                'required',
                'min:11',
                'numeric',
                Rule::unique('users', 'contact_number')->ignore($id),
            ],
        ]);
        
        $user = User::where('role', 'User')->with('admissionExam')->findOrFail($id);
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->email = $request->email;
        $user->contact_number = $request->contactNumber;           
        

        $user->admissionExam->score = $request->score;
  
        $user->save();
        $user->admissionExam->save();
               
        return redirect()->route('admin.dashboard.show-applicant');       
    }
    
    function DeleteApplicant($id){

        $user = User::where('role', 'User')->with('admissionExam')->findOrFail($id);
        $user->admissionExam->delete();
        $user->delete();
        
        return redirect()->back()->with('success', 'Question added successfully!');       
    }
}
