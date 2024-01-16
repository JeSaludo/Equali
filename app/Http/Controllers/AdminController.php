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
use App\Models\UserTimeStamp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{

    // function ShowOverview(Request $request){
    //     $academicYears = AcademicYears::all();
      
    //     $selectedAcademicYear = $request->input('academicYears');
        
    //     if(isset($selectedAcademicYear))
    //     {
            
    //     }
    //     $user = DB::table('users')
    //     ->select('users.*');
        
    //    $user = $user->get();

    //    $option = Option::first();

    //    if($option->academic_year_name != null){
    //         $selectedDefaultYear = AcademicYears::where('year_name', $option->academic_year_name)->first();
        
            
    //         $dateRange = [];


    //         $start = Carbon::parse($selectedDefaultYear->start_date);
    //         $end = Carbon::parse($selectedDefaultYear->end_date);
            
    //         $dateRangeLabels = [];
    //         while ($start <= $end) {
    //             $dateRangeLabels[] = $start->format('F Y');
    //             $start->addMonth();
    //         }
            
    //         $startMonth = $request->input('start_month');
    //         $endMonth = $request->input('end_month');
        
    //         // Additional condition to filter data based on selected date range
    //         $userTimeStamps = DB::table('user_time_stamps')
    //             ->select(DB::raw('MONTH(qualification_date) as month'), 'qualification_status', DB::raw('count(*) as count'))
    //             ->whereBetween('qualification_date', [$startMonth, $endMonth])
    //             ->groupBy('month', 'qualification_status')
    //             ->get();

    //     // Separate the data into arrays for each qualification status
    //     $qualifiedData = [];
    //     $unqualifiedData = [];
    //     $waitlistedData = [];

    //     foreach ($userTimeStamps as $row) {
    //         switch ($row->qualification_status) {
    //             case 'Qualified':
    //                 $qualifiedData[$row->month] = $row->count;
    //                 break;
    //             case 'Unqualified':
    //                 $unqualifiedData[$row->month] = $row->count;
    //                 break;
    //             case 'Waitlisted':
    //                 $waitlistedData[$row->month] = $row->count;
    //                 break;
    //         }
    //     }

    //         // Pass the chart data to the view
    //         $chartData = [
    //             'qualifiedData' => json_encode(array_values($qualifiedData)),
    //             'unqualifiedData' => json_encode(array_values($unqualifiedData)),
    //             'waitlistedData' => json_encode(array_values($waitlistedData)),
    //         ];
    //         $dateRange = json_encode($dateRangeLabels);
    //     // Return the view with all the data
    //     return view('admin.overview', compact(
    //     'academicYears',
    //     'selectedAcademicYear',
    //     'request',
    //     'user',
    //     'selectedDefaultYear',
    //     'dateRange',
    //     'chartData'
    // ));
            
    //        // return view('admin.overview', compact('academicYears','selectedAcademicYear','request','user','selectedDefaultYear' ,'dateRange'));
        

    //     }else{
    //         return redirect()->back()->with('error', 'Add academic year first to proceed');
    //     }
       
       
    // }
   
    function getMonthsArray($startDate, $endDate)
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
    
        $months = [];
    
        while ($start->lessThanOrEqualTo($end)) {
            $months[] = $start->format('F Y'); // Format as "Month Year"
            $start->addMonth(); // Move to the next month
        }
    
        return $months;
    }
    function ShowOverview(Request $request){
        $academicYears = AcademicYears::all();
      
        $selectedAcademicYear = $request->input('academicYears');        
       
        $user = DB::table('users')
        ->select('users.*');       
      
       $option = Option::first();

       if($option->academic_year_name != null){
            $selectedDefaultYear = AcademicYears::where('year_name', $option->academic_year_name)->first();
           
            // $startDate = null;
            // $endDate  = null;
           

            // if (isset($selectedAcademicYear)) {
            //     $selected_academicYear = AcademicYears::where('id', $selectedAcademicYear)->first();
            //     $startDate = $selected_academicYear->start_date;
            //     $endDate = $selectedDefaultYear->end_date;
             
            // }
            // else{
               
            //     $startDate = $selectedDefaultYear->start_date;
            //     $endDate = $selectedDefaultYear->end_date;
             

            // }
           
           
            
            // $qualifiedCount = DB::table('users')
            // ->select('users.*', 'user_time_stamps.qualification_date', 'user_time_stamps.qualification_status')
            // ->join('user_time_stamps', 'user_time_stamps.user_id', '=', 'users.id')
            // ->where('users.role', 'Student');
                        

            
            
            
            
            // $qualifiedCount = $qualifiedCount->get();
            
          
             $user = $user->get();
        
           
            
           
            // Now $qualificationData is an associative array where keys are status and month_year, and values are counts
            $qualifiedData = User::selectRaw('MONTH(updated_at) as month, COUNT(*) as count')
            ->where('role', 'Student')
            ->where('status', 'Qualified');
        
        if (isset($selectedAcademicYear)) {
            $qualifiedData->where('users.academic_year_id', $selectedAcademicYear);
        } else {
            $qualifiedData->where('users.academic_year_id', $selectedDefaultYear->id);
        }
        
        $qualifiedData = $qualifiedData->groupBy('month')->get();
        
        $unqualifiedData = User::selectRaw('MONTH(updated_at) as month, COUNT(*) as count')
            ->where('role', 'Student')
            ->where('status', 'Unqualified');
        
        if (isset($selectedAcademicYear)) {
            $unqualifiedData->where('users.academic_year_id', $selectedAcademicYear);
        } else {
            $unqualifiedData->where('users.academic_year_id', $selectedDefaultYear->id);
        }
        
        $unqualifiedData = $unqualifiedData->groupBy('month')->get();
        
        $waitlistedData = User::selectRaw('MONTH(updated_at) as month, COUNT(*) as count')
            ->where('role', 'Student')
            ->where('status', 'Waitlisted');
        
        if (isset($selectedAcademicYear)) {
            $waitlistedData->where('users.academic_year_id', $selectedAcademicYear);
        } else {
            $waitlistedData->where('users.academic_year_id', $selectedDefaultYear->id);
        }
        
        $waitlistedData = $waitlistedData->groupBy('month')->get();
        
        $labels = [];
        $qualifiedDataset = [];
        $unqualifiedDataset = [];
        $waitlistedDataset = [];
        
        foreach ($qualifiedData as $user) {
            $month = date('F', mktime(0, 0, 0, $user->month, 1));
            array_push($labels, $month);
            array_push($qualifiedDataset, $user->count);
        }
        
        foreach ($unqualifiedData as $user) {
            array_push($unqualifiedDataset, $user->count);
        }
        
        foreach ($waitlistedData as $user) {
            array_push($waitlistedDataset, $user->count);
        }
        
        $datasets = [
            [
                'label' => "Qualified",
                'data' => $qualifiedDataset,
            ],
            [
                'label' => "Unqualified",
                'data' => $unqualifiedDataset,
            ],
            [
                'label' => "Waitlisted",
                'data' => $waitlistedDataset,
            ],
        ];
        

        return view('admin.overview', compact(
            'academicYears',
            'selectedAcademicYear',
            'request',
            'user',
            'selectedDefaultYear',
            'labels',
            'qualifiedDataset',
            'unqualifiedDataset',
            'waitlistedDataset'
        ));

            
            
           

        }else{
            return redirect()->back()->with('error', 'Add academic year first to proceed');
        }
       
       
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
        return view('admin.dashboard-overview-proctor', compact('users' , 'totalInterview', 'pendingInterview','finishedInterview'));
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
        $users->appends([
            'academicYears' => $request->academicYears,
            // 'sort_column' => $sortColumn,
            // 'sort_order' => $sortOrder,
            // 'searchTerm' => $searchTerm,
        ]);       

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
        $users->appends([
            'academicYears' => $request->academicYears,
            // 'sort_column' => $sortColumn,
            // 'sort_order' => $sortOrder,
            // 'searchTerm' => $searchTerm,
        ]);     
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
                return redirect()->route('dean.admission');
            }
            
        }
        else if($user->role === "ProgramHead"){
            return redirect()->route('programhead.admission');
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
                    $timestamp = UserTimeStamp::where('user_id', $user->id)->first();
            
                    $timestamp->qualification_date = Carbon::now();
                    $timestamp->qualification_status = "Qualified";
                    $timestamp->save(); 
                    $qualifiedCount++; // Increment qualified count
                } else {
                    $userModel->status = "Unqualified";
                    $timestamp = UserTimeStamp::where('user_id', $user->id)->first();
            
                    $timestamp->qualification_date = Carbon::now();
                    $timestamp->qualification_status = "Unqualified";
                    $timestamp->save(); 
                    // No email sending for unqualification
                }
            } else {
                if ($userModel->result->weighted_average >= $option->qualified_student_passing_average) {
                    $userModel->status = "Waitlisted";
                    $timestamp = UserTimeStamp::where('user_id', $user->id)->first();
            
                    $timestamp->qualification_date = Carbon::now();
                    $timestamp->qualification_status = "Waitlisted";
                    $timestamp->save(); 
                    // No email sending for waitlisting
                } else {
                    $userModel->status = "Unqualified";
                    $timestamp = UserTimeStamp::where('user_id', $user->id)->first();
            
                    $timestamp->qualification_date = Carbon::now();
                    $timestamp->qualification_status = "Unqualified";
                    $timestamp->save(); 
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
        return redirect()->route('dean.admission')->with('success', 'Setting updated successfully!');
    }
    
    function UpdateSettingForAcad(Request $request){    
        $request->validate([
           'acad_year' => 'required',
        ]);
        $option = Option::first();           
        $option->academic_year_name = $request->acad_year;
        $option->save();
        return redirect()->route('dean.admission')->with('success', 'setting updated successfully!');
    }


   
}
