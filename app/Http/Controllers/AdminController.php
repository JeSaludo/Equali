<?php

namespace App\Http\Controllers;

use App\Models\AcademicYears;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Option;
use App\Models\Exam;
use App\Models\ExamQuestion;
use Carbon\Carbon;
use App\Models\StudentInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{

    function ShowOverview(){
        return view('admin.overview');
    }
    function ShowRecent(){
        return view('admin.recent-activity');
    }



    function ShowDashboard()
    {
        
        return view('admin.dean.dashboard');
    }

    function ShowAdminOverview()
    {   
        $users = User::where('role','Student')->where('status','Pending Interview')->orWhere('status', 'Pending Schedule');

        $users = $users->paginate(10);

        $totalInterview = StudentInfo::where('interview', true)->count() + User::where('role', 'Student')->where('status', 'Pending Interview')->count();

        $pendingInterview = User::where('role', 'Student')->where('status', 'Pending Interview')->count();

        $finishedInterview = StudentInfo::where('interview', true)->count();
        return view('admin.dashboard-overview', compact('users' , 'totalInterview', 'pendingInterview','finishedInterview'));
    }
    function ShowScheduledCalendar(Request $request){

        $users = DB::table('users')
        ->select('users.*', 'qualified_students.*')
        ->join('qualified_students', 'qualified_students.user_id', '=', 'users.id')
        ->where('users.role', 'Student')->where('users.status', 'Pending Interview');

    
      
        $selectedDate = $request->input('selectDate');

        // Check if a date is selected
        if ($selectedDate) {
            $users->where('exam_schedule_date', $selectedDate);
            
        }
      
        $scheduledUsersCount = $users->count();
        $option = Option::first();
        
       
        $users = $users->get();

        $slotLimit = $option->slot_per_day;
        return view('admin.dashboard-view-appointed-date', compact( 'users' ,'slotLimit','scheduledUsersCount'));
    }
    

    function ShowScheduleInterview(Request $request){
        
        $academicYears = AcademicYears::all();

        $selectedAcademicYear = $request->input('academicYears');
       
        $users = DB::table('users')
        ->select('users.*', 'qualified_students.*')
        ->join('qualified_students', 'qualified_students.user_id', '=', 'users.id')
        ->leftJoin('student_infos', 'student_infos.user_id', '=', 'users.id')
        ->where('users.role', 'Student')
        ->where('status', 'Pending Schedule')
        ->whereNull('student_infos.user_id')
        ->orderBy('users.created_at', 'desc');                
        
      
        $userCount = User::all();        

        if(isset($selectedAcademicYear)){
            $users->where('academic_year_id', $selectedAcademicYear);
        }
        
        $searchTerm = $request->input('searchTerm');

        if ($searchTerm) {
            $users->where(function ($query) use ($searchTerm) {
            $query->where('users.first_name', 'like', '%' . $searchTerm . '%')
            ->orWhere('users.last_name', 'like', '%' . $searchTerm . '%')
            ->orWhere('users.id', 'like', '%' . $searchTerm . '%')
            ->where('users.status', 'Pending Schedule'); // Add the condition for pending schedule status
            });
        }

        $users = $users->paginate(10);
        $users->appends(['academicYears' => $request->academicYears]);
        return view('admin.dashboard-view-schedule-for-interview',[
            'userCount' => $userCount,
            'academicYears' => $academicYears,
            'users' => $users,
            'request' => $request,          
            'searchTerm '=>  $searchTerm,
        ]);
    }

    function ShowScheduledInterview(Request $request)
    {
       
        
        $academicYears = AcademicYears::all();

        $selectedAcademicYear = $request->input('academicYears');
       
        $users = DB::table('users')
        ->select('users.*', 'qualified_students.*')
        ->join('qualified_students', 'qualified_students.user_id', '=', 'users.id')
        ->leftJoin('student_infos', 'student_infos.user_id', '=', 'users.id')
        ->where('users.role', 'Student')
        ->where('status', 'Pending Interview')
        ->whereNull('student_infos.user_id')
        ->orderBy('users.created_at', 'desc');                
        
        $userCount = User::all();        

        if(isset($selectedAcademicYear)){

            $users->where('academic_year_id', $selectedAcademicYear);
        }
        
        $searchTerm = $request->input('searchTerm');

        if ($searchTerm) {
            $users->where(function ($query) use ($searchTerm) {
            $query->where('users.first_name', 'like', '%' . $searchTerm . '%')
            ->orWhere('users.last_name', 'like', '%' . $searchTerm . '%')
            ->orWhere('users.id', 'like', '%' . $searchTerm . '%')
            ->where('users.status', 'Pending Interview'); // Add the condition for pending schedule status
            });
        }
      
        $users = $users->paginate(10);
        $users->appends(['academicYears' => $request->academicYears]);
        return view('admin.dashboard-view-scheduled-interview',[
            'userCount' => $userCount,
            'academicYears' => $academicYears,
            'users' => $users,
            'request' => $request,          
            'searchTerm '=>  $searchTerm,
        ]);
    

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

        
        if ($user->role === "Proctor") {
            return redirect()->route('admin.dashboard.overview.proctor');
        } else if ($user->role === "Student") {
            return redirect()->route('home');
        }
        else if($user->role === "Dean" ){

            if($user->academic_year_id === null){
                return redirect()->route('admin.show-setting')->with('error','Create a Academic Year to complete the setup');
            }
            else{
                return redirect()->route('admin.overview.dean');
            }
            
        }
        else if($user->role === "ProgramHead"){
            return redirect()->route('dean.admission');
        }
        
    }

    function ShowSetting(){
        $option = Option::first();
        $academicYears = AcademicYears::all();
        return view('admin.employee.admin-setting', compact('option','academicYears'));
    }

    public function UpdateSetting(Request $request)
    {
        $request->validate([
            'qualifying_passing_score' => 'required|integer',
            'qualifying_number_of_items' => 'required|integer',
            'qualifying_timer' => 'required|integer|min:0',
            'qualified_student_passing_average' => 'required|numeric|between:0,5',
            'slot_per_day' => 'required',
            'number_of_qualified' => 'required|min:1',
        ]);

        $option = Option::first();
        $oldMaxQuestionsAllowed = $option->qualifying_number_of_items;
        $newMaxQuestionsAllowed = $request->qualifying_number_of_items;

        // Update option values
        $option->qualified_student_passing_average = $request->qualified_student_passing_average;
        $option->qualifying_number_of_items = $newMaxQuestionsAllowed;
        $option->qualifying_passing_score = $request->qualifying_passing_score;
        $option->qualifying_timer = $request->qualifying_timer;
        $option->slot_per_day = $request->slot_per_day;
        $option->number_of_qualified = $request->number_of_qualified;
        $option->save();

       
        $acadYear = Option::where('academic_year_name', $option->academic_year_name)->first();
        
        $selectedYear = $acadYear->id;
        
        $users = DB::table('users')
        ->select('users.*', 'results.weighted_average')
        ->join('results', 'results.user_id', '=', 'users.id')
        ->where('users.role', 'Student')
        ->where(function ($query) {
            $query->where('users.status', 'Qualified')
                ->orWhere('users.status', 'Waitlisted')
                ->orWhere('users.status', 'Unqualified');
        })
        ->where('academic_year_id', $selectedYear)
        ->orderBy('results.weighted_average', 'DESC') 
        ->get();

       
        $qualifiedCount = User::where('role', 'Student')
        ->where('status', 'Qualified')
        ->where('academic_year_id', $selectedYear)->count();

        $numberOfQualified = $option->number_of_qualified;

        $numberOfQualified = $option->number_of_qualified;
        $qualifiedCount = 0; // Initialize the qualified count
        
        foreach ($users as $user) {
            $userModel = User::with('result')->find($user->id);
        
            if ($qualifiedCount < $numberOfQualified) {
                if ($userModel->result->weighted_average >= $option->qualified_student_passing_average) {
                    $userModel->status = "Qualified";
                    $qualifiedCount++; // Increment qualified count
                } else {
                    $userModel->status = "Unqualified";
                    // No email sending for unqualification
                }
            } else {
                if ($userModel->result->weighted_average >= $option->qualified_student_passing_average) {
                    $userModel->status = "Waitlisted";
                    // No email sending for waitlisting
                } else {
                    $userModel->status = "Unqualified";
                    // No email sending for unqualification
                }
            }
        
            $userModel->save();
        }
        
        
        // Check if the new max questions allowed is less than the old value
        if ($newMaxQuestionsAllowed < $oldMaxQuestionsAllowed) {
            $examIds = Exam::pluck('id');
            foreach ($examIds as $examId) {
                $exam = Exam::find($examId);
                $examQuestionCount = $exam->examQuestion()->count();

                // Remove excess questions if they exist
                if ($examQuestionCount > $newMaxQuestionsAllowed) {
                    $questionsToRemove = $examQuestionCount - $newMaxQuestionsAllowed;
                    $questionIdsToRemove = $exam->examQuestion()->latest()->take($questionsToRemove)->pluck('question_id')->toArray();
                    
                    // Remove excess questions from ExamQuestion pivot table
                    ExamQuestion::where('exam_id', $examId)
                        ->whereIn('question_id', $questionIdsToRemove)
                        ->delete();
                }
            }
        }
        return redirect()->route('admin.overview.dean')->with('success', 'Setting updated successfully!');
    }
    
    function UpdateSettingForAcad(Request $request){    
        $request->validate([
           'acad_year' => 'required',
        ]);
        $option = Option::first();           
        $option->academic_year_name = $request->acad_year;
        $option->save();
        return redirect()->route('admin.overview.dean')->with('success', 'setting updated successfully!');
    }


   
}
