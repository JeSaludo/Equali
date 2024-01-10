<?php

namespace App\Exports;

use App\Models\Result;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class QualifiedITExport implements FromView
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
        ->where('users.role', 'Student')
        ->where('users.status', 'Qualified')
        ->where('student_infos.course','IT')
        ->whereNotNull('weighted_average')
        ->orderByDesc('weighted_average');

        if(isset($selectedAcademicYear)){
            $users->where('academic_year_id', $selectedAcademicYear);
        }
        $users = $users->get();
        return view('exports.qualified-it', ['users' => $users]);
    }
}
