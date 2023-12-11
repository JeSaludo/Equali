<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    function ShowAdminOverview()
    {
        $user = User::where('role', 'Student')->get();

        $recentApplicants = User::where('role', 'Student')
        ->with('admissionExam')
        ->latest('created_at')
        ->limit(5)
        ->get();

        $recentInterviews = User::where('role', 'Student')->get();

        if(auth()->user()->role === "ProgramHead"){
            $recentUsers = User::where('role', 'Student')
            ->where('status', 'Pending')->orWhere('status', 'Pending Schedule')
            ->orWhere('status', 'Ready For Exam')
            ->orWhere('status', 'Pending Interview')
            ->latest('created_at')
            ->limit(5)
            ->get();
        }
        else if(auth()->user()->role === "Proctor"){
            $recentUsers = User::where('role', 'Student')
            ->where('status', 'Pending Interview')
            // ->orWhere('status', 'Ready For Exam')
            ->latest('created_at')
            ->limit(5)
            ->get();
        }
        else if(auth()->user()->role === "Dean"){
            $recentUsers = User::where('role', 'Student')
            ->with('admissionExam')
            ->latest('created_at')
            ->limit(5)
            ->get();
        }
        

        $totalInterview = User::with('studentInfo')
        ->whereHas('studentInfo', function ($query) {
            $query->where('interview', 1);
        });

       

        

        return view('admin.dashboard-overview', compact('recentApplicants', 'user', 'recentUsers','totalInterview'));
    }

    function ShowScheduleInterview(){
        $userCount = User::all();
        $users = User::where('role', 'Student')->where('status', 'Pending Schedule')
        ->with('qualifiedStudent')
        ->doesntHave('studentInfo')
        ->latest('created_at');

        $users = $users->paginate(10);
        return view('admin.dashboard-view-schedule-for-interview', compact( 'users', 'userCount'));
    }

    function ShowScheduledInterview()
    {
        $userCount = User::all();
        $users = User::where('role', 'Student')->where('status', 'Pending Interview')
        ->with('qualifiedStudent')
        ->doesntHave('studentInfo')
        ->latest('created_at');

        $users = $users->paginate(10);
        return view('admin.dashboard-view-scheduled-interview', compact( 'users', 'userCount'));

    }

    function ShowEmployee(){

        $users = User::where('role', '!=', 'Student')->paginate(10);


        return view('admin.employee.admin-view-employee', compact('users'));
    }
    
    function ShowProfile($id){

        $user = User::find($id);
        return view('admin.employee.admin-profile', compact('user'));
    }

    function UpdateProfile(Request $request, $id){

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ]);

        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'you have changed your profile successfuly');
    }

    function ShowSetting(){
        $option = Option::first();
        return view('admin.employee.admin-setting', compact('option'));
    }

    function UpdateSetting(Request $request){


        $request->validate([
            'qualifying_passing_score' => 'required|integer', // Adjust the range as needed
            'qualifying_number_of_items' => 'required|integer', // Adjust the range as needed
            'qualifying_timer' => 'required|integer|min:0',
            'qualified_student_passing_average' => 'required|numeric|between:0,5',
        ]);
        $option = Option::first();
        $option->qualified_student_passing_average = $request->qualified_student_passing_average;
        $option->qualifying_number_of_items = $request->qualifying_number_of_items;
        $option->qualifying_passing_score = $request->qualifying_passing_score;
        $option->qualifying_timer = $request->qualifying_timer;
        $option->save();
        return redirect()->route('admin.dashboard.overview')->with('success', 'Questions added successfully!');
    }
    

   
}
