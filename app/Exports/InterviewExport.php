<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Result;

class InterviewExport implements FromView
{
  
    public function view(): View
    {
        $results = Result::with('user')->whereNotNull('measure_a_score')->orderByDesc('measure_a_score')
        ->get();
        return view('exports.interview-report', ['results' => $results]);
    }
}




