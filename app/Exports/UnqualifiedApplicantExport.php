<?php

namespace App\Exports;
use App\Models\Result;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
class UnqualifiedApplicantExport implements FromView
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
        ->whereNotNull('weighted_average')      
        ->where('users.status', 'Unqualified');
        

       
        if(isset($selectedAcademicYear)){
            $users->where('academic_year_id', $selectedAcademicYear);
        }

        $users = $users->get();
        return view('exports.unqualified-applicant', ['users' => $users]);
     
    }
}
