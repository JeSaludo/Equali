<?php

namespace App\Exports;

use App\Models\Result;
use App\Models\Option;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class ResultExport implements FromView
{ 
    
    public $selectedYear;
    public function __construct($selectedYear){

            $this->selectedYear = $selectedYear;
    }
   
    public function view(): View
    {
        $selectedAcademicYear = $this->selectedYear;
       
        $users = DB::table('users')
        ->select('users.*', 'results.*')
        ->join('results', 'results.user_id', '=', 'users.id')        
        ->where('users.role', 'Student') 
        ->whereNotNull('results.weighted_average')
        ->orderByDesc('results.total_exam_score');

       
        if(isset($selectedAcademicYear)){
            $users->where('academic_year_id', $selectedAcademicYear);
        }

        $users = $users->get();
        $option = Option::first();
        return view('exports.qualified-exam-report', ['users' => $users, 'option' => $option]);
            
     
       
    }
}
