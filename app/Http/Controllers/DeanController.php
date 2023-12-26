<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class DeanController extends Controller
{
    public function ShowAdmission(){
        $totalUserCount = User::where('role' , 'Student')->count();
     $forInterviewCount = User::where('status' , 'Pending Interview')->count();
        $forQualifiedCount = User::where('status' , 'Qualified')->count();
        $forUnqualifiedCount = User::where('status' , 'Unqualified')->count();
        $forWaitListedCount = User::where('status' , 'Waitlisted')->count();
        $forQualifyingExamCount = User::where('status' , 'Ready For Exam')->count();
    
        $users = User::where('role' , 'Student')->orderByDesc('created_at')->paginate();
    
        return view('admin.dean.dashboard-view-admission', compact('totalUserCount', 'forInterviewCount', 'forQualifiedCount', 'forUnqualifiedCount', 'forWaitListedCount', 'forQualifyingExamCount', 'users'));
    }
    

    public function ShowAdmissionQualified(){

        $totalUserCount = User::where('role' , 'Student')->count();
     $forInterviewCount = User::where('status' , 'Pending Interview')->count();
        $forQualifiedCount = User::where('status' , 'Qualified')->count();
        $forUnqualifiedCount = User::where('status' , 'Unqualified')->count();
        $forWaitListedCount = User::where('status' , 'Waitlisted')->count();
        $forQualifyingExamCount = User::where('status' , 'Ready For Exam')->count();
        $user = User::where('role' , 'Student');

        $users = User::where('role' , 'Student')->where('status', 'Qualified');
        $users =  $users->orderByDesc('created_at')->paginate();

        return view('admin.dean.dashboard-view-admission-for-qualified',compact('totalUserCount', 'forInterviewCount', 'forQualifiedCount', 'forUnqualifiedCount', 'forWaitListedCount', 'forQualifyingExamCount', 'users'));
    }
    public function ShowAdmissionUnqualified(){
        $totalUserCount = User::where('role' , 'Student')->count();
     $forInterviewCount = User::where('status' , 'Pending Interview')->count();
        $forQualifiedCount = User::where('status' , 'Qualified')->count();
        $forUnqualifiedCount = User::where('status' , 'Unqualified')->count();
        $forWaitListedCount = User::where('status' , 'Waitlisted')->count();
        $forQualifyingExamCount = User::where('status' , 'Ready For Exam')->count();
   
        $users = User::where('role' , 'Student')->where('status', 'Unqualified');
        $users =  $users->orderByDesc('created_at')->paginate();

        return view('admin.dean.dashboard-view-admission-for-not-qualified',compact('totalUserCount', 'forInterviewCount', 'forQualifiedCount', 'forUnqualifiedCount', 'forWaitListedCount', 'forQualifyingExamCount', 'users'));
    }

    public function ShowAdmissionInterview(){
        $totalUserCount = User::where('role' , 'Student')->count();
     $forInterviewCount = User::where('status' , 'Pending Interview')->count();
        $forQualifiedCount = User::where('status' , 'Qualified')->count();
        $forUnqualifiedCount = User::where('status' , 'Unqualified')->count();
        $forWaitListedCount = User::where('status' , 'Waitlisted')->count();
        $forQualifyingExamCount = User::where('status' , 'Ready For Exam')->count();

        $users = User::where('role' , 'Student')->where('status', 'Ready For Interview');
        $users =  $users->orderByDesc('created_at')->paginate();

        return view('admin.dean.dashboard-view-admission-for-interview', compact('totalUserCount', 'forInterviewCount', 'forQualifiedCount', 'forUnqualifiedCount', 'forWaitListedCount', 'forQualifyingExamCount', 'users'));
    }

    public function ShowAdmissionWaitlisted(){
        $totalUserCount = User::where('role' , 'Student')->count();
     $forInterviewCount = User::where('status' , 'Pending Interview')->count();
        $forQualifiedCount = User::where('status' , 'Qualified')->count();
        $forUnqualifiedCount = User::where('status' , 'Unqualified')->count();
        $forWaitListedCount = User::where('status' , 'Waitlisted')->count();
        $forQualifyingExamCount = User::where('status' , 'Ready For Exam')->count();

        $users = User::where('role' , 'Student')->where('status', 'Waitlisted');
        $users =  $users->orderByDesc('created_at')->paginate();

        return view('admin.dean.dashboard-view-admission-for-waitlisted', compact('totalUserCount', 'forInterviewCount', 'forQualifiedCount', 'forUnqualifiedCount', 'forWaitListedCount', 'forQualifyingExamCount', 'users'));
    }
    public function ShowAdmissionExam(){
        $totalUserCount = User::where('role' , 'Student')->count();
     $forInterviewCount = User::where('status' , 'Pending Interview')->count();
        $forQualifiedCount = User::where('status' , 'Qualified')->count();
        $forUnqualifiedCount = User::where('status' , 'Unqualified')->count();
        $forWaitListedCount = User::where('status' , 'Waitlisted')->count();
        $forQualifyingExamCount = User::where('status' , 'Ready For Exam')->count();

        $users = User::where('role' , 'Student')->where('status', 'Ready For Exam');
        $users =  $users->orderByDesc('created_at')->paginate();

        return view('admin.dean.dashboard-view-admission-qualifying-exam', compact('totalUserCount', 'forInterviewCount', 'forQualifiedCount', 'forUnqualifiedCount', 'forWaitListedCount', 'forQualifyingExamCount', 'users'));
    }
}
