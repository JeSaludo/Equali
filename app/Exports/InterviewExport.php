<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Result;
use App\Models\AcademicYears;
use Illuminate\Support\Facades\DB;

class InterviewExport implements FromView
{
    public $selectedYear;
    public function __construct($selectedYear){

            $this->selectedYear = $selectedYear;
    }

    public function view(): View
    {
        

        $selectedAcademicYear = $this->selectedYear;
       
        $users = DB::table('users')
        ->select('users.*', 'results.*', 'student_infos.*')
        ->join('results', 'results.user_id', '=', 'users.id')
        ->join('student_infos', 'student_infos.user_id', '=', 'users.id') 
        ->whereNotNull('measure_a_score')
        ->where('users.role', 'Student')
        ->orderByDesc('measure_a_score');

        

        if(isset($selectedAcademicYear)){
            $users->where('academic_year_id', $selectedAcademicYear);
        }
        $users = $users->get();
       
       
        
        return view('exports.interview-report', ['users' => $users]);
    }
}




