<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicYears;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DeanController extends Controller
{
    private function getUserCounts($academicYearId = null){
        $users = User::where('role' , 'Student');

        if (isset($academicYearId)) {
           
            $users->where('academic_year_id', $academicYearId);

        }
        $users = $users->get();
      
        return [
            "totalUserCount" => User::where('role' , 'Student')->count(),
            "forInterviewCount" => User::where('status' , 'Pending Interview')->count(),
            "forQualifiedCount" => User::where('status' , 'Qualified')->count(),
            "forUnqualifiedCount" => User::where('status' , 'Unqualified')->count(),
            "forWaitListedCount" => User::where('status' , 'Waitlisted')->count(),
            "forQualifyingExamCount" => User::where('status' , 'Ready For Exam')->count(),
        ];
    }

    public function ShowAdmission(Request $request){
       
        $userCounts = $this->getUserCounts($request->input('academicYears'));
        $sortColumn = $request->input('sort_column', 'id'); 
        $sortOrder = $request->input('sort_order', 'asc');  

        $academicYears = AcademicYears::all();

        $selectedAcademicYear = $request->input('academicYears');
        

        $users = DB::table('users')
        ->select('users.*', 'admission_exams.raw_score', 'admission_exams.percentage')
        ->join('admission_exams', 'admission_exams.user_id', '=', 'users.id')
        ->where('users.role', 'Student');
        
        if(isset($selectedAcademicYear)){
            $users->where('academic_year_id', $selectedAcademicYear);
        }

        $searchTerm = $request->input('searchTerm');

        if($searchTerm) {
            $users->where('users.first_name', 'like', '%' . $searchTerm . '%')
            ->orWhere('users.last_name', 'like', '%' . $searchTerm . '%')
            ->orWhere('users.id', 'like', '%' . $searchTerm . '%')  ;         
   
        }
        
        $users->orderBy($sortColumn, $sortOrder);
        $users = $users->paginate(10);
        $users->appends(['academicYears' => $request->academicYears]);

        return view('admin.dean.dashboard-view-admission', [
            'totalUserCount' => $userCounts['totalUserCount'],
            'forInterviewCount' => $userCounts['forInterviewCount'],           
            'forQualifiedCount' => $userCounts['forQualifiedCount'],
            'forUnqualifiedCount' => $userCounts['forUnqualifiedCount'],
            'forWaitListedCount' => $userCounts['forWaitListedCount'],
            'forQualifyingExamCount' => $userCounts['forQualifyingExamCount'],
            'academicYears' => $academicYears,
            'users' => $users,
            'request' => $request,
            'sortColumn' => $sortColumn,
            'sortOrder' => $sortOrder,
            'searchTerm' => $searchTerm,
        ]);
     }
    

    public function ShowAdmissionQualified(Request $request){
    
        $userCounts = $this->getUserCounts($request->input('academicYears'));
        $sortColumn = $request->input('sort_column', 'id'); 
        $sortOrder = $request->input('sort_order', 'asc');  

        $academicYears = AcademicYears::all();

        $selectedAcademicYear = $request->input('academicYears');
       
        $users = DB::table('users')
        ->select('users.*', 'admission_exams.raw_score', 'admission_exams.percentage')
        ->join('admission_exams', 'admission_exams.user_id', '=', 'users.id')
        ->where('users.role', 'Student')->where('users.status', 'Qualified');
        
        if(isset($selectedAcademicYear)){
            $users->where('academic_year_id', $selectedAcademicYear);
        }

        $searchTerm = $request->input('searchTerm');

        if($searchTerm) {
            $users->where('users.first_name', 'like', '%' . $searchTerm . '%')
            ->orWhere('users.last_name', 'like', '%' . $searchTerm . '%')
            ->orWhere('users.id', 'like', '%' . $searchTerm . '%')  ;         
   
        }

        $users->orderBy($sortColumn, $sortOrder);
        $users = $users->paginate(10);
        $users->appends(['academicYears' => $request->academicYears]);

        return view('admin.dean.dashboard-view-admission-for-qualified', [
            'totalUserCount' => $userCounts['totalUserCount'],
            'forInterviewCount' => $userCounts['forInterviewCount'],           
            'forQualifiedCount' => $userCounts['forQualifiedCount'],
            'forUnqualifiedCount' => $userCounts['forUnqualifiedCount'],
            'forWaitListedCount' => $userCounts['forWaitListedCount'],
            'forQualifyingExamCount' => $userCounts['forQualifyingExamCount'],
            'academicYears' => $academicYears,
            'users' => $users,
            'request' => $request,
            'sortColumn' => $sortColumn,
            'sortOrder' => $sortOrder,
            'searchTerm' => $searchTerm,
        ]);
    }
    public function ShowAdmissionUnqualified(Request $request){
        $userCounts = $this->getUserCounts($request->input('academicYears'));
        $sortColumn = $request->input('sort_column', 'id'); 
        $sortOrder = $request->input('sort_order', 'asc');  

        $academicYears = AcademicYears::all();

        $selectedAcademicYear = $request->input('academicYears');
       
        $users = DB::table('users')
        ->select('users.*', 'admission_exams.raw_score', 'admission_exams.percentage')
        ->join('admission_exams', 'admission_exams.user_id', '=', 'users.id')
        ->where('users.role', 'Student')->where('users.status', 'Unqualified');
        
        if(isset($selectedAcademicYear)){
            $users->where('academic_year_id', $selectedAcademicYear);
        }

        $searchTerm = $request->input('searchTerm');

        if($searchTerm) {
            $users->where('users.first_name', 'like', '%' . $searchTerm . '%')
            ->orWhere('users.last_name', 'like', '%' . $searchTerm . '%')
            ->orWhere('users.id', 'like', '%' . $searchTerm . '%')  ;         
   
        }

        $users->orderBy($sortColumn, $sortOrder);
        $users = $users->paginate(10);
        $users->appends(['academicYears' => $request->academicYears]);

        return view('admin.dean.dashboard-view-admission-for-not-qualified', [
            'totalUserCount' => $userCounts['totalUserCount'],
            'forInterviewCount' => $userCounts['forInterviewCount'],           
            'forQualifiedCount' => $userCounts['forQualifiedCount'],
            'forUnqualifiedCount' => $userCounts['forUnqualifiedCount'],
            'forWaitListedCount' => $userCounts['forWaitListedCount'],
            'forQualifyingExamCount' => $userCounts['forQualifyingExamCount'],
            'academicYears' => $academicYears,
            'users' => $users,
            'request' => $request,
            'sortColumn' => $sortColumn,
            'sortOrder' => $sortOrder,
            'searchTerm' => $searchTerm,
        ]); }

    public function ShowAdmissionInterview(Request $request){
        $userCounts = $this->getUserCounts($request->input('academicYears'));
        $sortColumn = $request->input('sort_column', 'id'); 
        $sortOrder = $request->input('sort_order', 'asc');  

        $academicYears = AcademicYears::all();

        $selectedAcademicYear = $request->input('academicYears');
       
        $users = DB::table('users')
        ->select('users.*', 'admission_exams.raw_score', 'admission_exams.percentage')
        ->join('admission_exams', 'admission_exams.user_id', '=', 'users.id')
        ->where('users.role', 'Student')->where('users.status', 'Pending Interview');
        
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

        $users->orderBy($sortColumn, $sortOrder);
        $users = $users->paginate(10);
        $users->appends(['academicYears' => $request->academicYears]);

        return view('admin.dean.dashboard-view-admission-for-interview', [
            'totalUserCount' => $userCounts['totalUserCount'],
            'forInterviewCount' => $userCounts['forInterviewCount'],           
            'forQualifiedCount' => $userCounts['forQualifiedCount'],
            'forUnqualifiedCount' => $userCounts['forUnqualifiedCount'],
            'forWaitListedCount' => $userCounts['forWaitListedCount'],
            'forQualifyingExamCount' => $userCounts['forQualifyingExamCount'],
            'academicYears' => $academicYears,
            'users' => $users,
            'request' => $request,
            'sortColumn' => $sortColumn,
            'sortOrder' => $sortOrder,
            'searchTerm' => $searchTerm,
        ]);
       }

    public function ShowAdmissionWaitlisted(Request $request){
        $userCounts = $this->getUserCounts($request->input('academicYears'));
        $sortColumn = $request->input('sort_column', 'id'); 
        $sortOrder = $request->input('sort_order', 'asc');  

        $academicYears = AcademicYears::all();

        $selectedAcademicYear = $request->input('academicYears');
       
        $users = DB::table('users')
        ->select('users.*', 'admission_exams.raw_score', 'admission_exams.percentage')
        ->join('admission_exams', 'admission_exams.user_id', '=', 'users.id')
        ->where('users.role', 'Student')->where('users.status', 'Waitlisted');
        
        if(isset($selectedAcademicYear)){
            $users->where('academic_year_id', $selectedAcademicYear);
        }

        $searchTerm = $request->input('searchTerm');

        if($searchTerm) {
            $users->where('users.first_name', 'like', '%' . $searchTerm . '%')
            ->orWhere('users.last_name', 'like', '%' . $searchTerm . '%')
            ->orWhere('users.id', 'like', '%' . $searchTerm . '%')  ;         
   
        }

        $users->orderBy($sortColumn, $sortOrder);
        $users = $users->paginate(10);
        $users->appends(['academicYears' => $request->academicYears]);

        return view('admin.dean.dashboard-view-admission-for-waitlisted', [
            'totalUserCount' => $userCounts['totalUserCount'],
            'forInterviewCount' => $userCounts['forInterviewCount'],           
            'forQualifiedCount' => $userCounts['forQualifiedCount'],
            'forUnqualifiedCount' => $userCounts['forUnqualifiedCount'],
            'forWaitListedCount' => $userCounts['forWaitListedCount'],
            'forQualifyingExamCount' => $userCounts['forQualifyingExamCount'],
            'academicYears' => $academicYears,
            'users' => $users,
            'request' => $request,
            'sortColumn' => $sortColumn,
            'sortOrder' => $sortOrder,
            'searchTerm' => $searchTerm,
        ]);

       }
    public function ShowAdmissionExam(Request $request){
        $userCounts = $this->getUserCounts($request->input('academicYears'));
        $sortColumn = $request->input('sort_column', 'id'); 
        $sortOrder = $request->input('sort_order', 'asc');  

        $academicYears = AcademicYears::all();

        $selectedAcademicYear = $request->input('academicYears');
       
        $users = DB::table('users')
        ->select('users.*', 'admission_exams.raw_score', 'admission_exams.percentage')
        ->join('admission_exams', 'admission_exams.user_id', '=', 'users.id')
        ->where('users.role', 'Student')->where('users.status', 'Ready For Exam');
        
        if(isset($selectedAcademicYear)){
            $users->where('academic_year_id', $selectedAcademicYear);
        }


        $searchTerm = $request->input('searchTerm');

        if($searchTerm) {
            $users->where('users.first_name', 'like', '%' . $searchTerm . '%')
            ->orWhere('users.last_name', 'like', '%' . $searchTerm . '%')
            ->orWhere('users.id', 'like', '%' . $searchTerm . '%')  ;         
   
        }
        $users->orderBy($sortColumn, $sortOrder);
        $users = $users->paginate(10);
        $users->appends(['academicYears' => $request->academicYears]);

        return view('admin.dean.dashboard-view-admission-qualifying-exam', [
            'totalUserCount' => $userCounts['totalUserCount'],
            'forInterviewCount' => $userCounts['forInterviewCount'],           
            'forQualifiedCount' => $userCounts['forQualifiedCount'],
            'forUnqualifiedCount' => $userCounts['forUnqualifiedCount'],
            'forWaitListedCount' => $userCounts['forWaitListedCount'],
            'forQualifyingExamCount' => $userCounts['forQualifyingExamCount'],
            'academicYears' => $academicYears,
            'users' => $users,
            'request' => $request,
            'sortColumn' => $sortColumn,
            'sortOrder' => $sortOrder,
            'searchTerm' => $searchTerm,
        ]);
     }
    }
