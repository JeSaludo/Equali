<?php

namespace App\Exports;

use App\Models\Result;
use App\Models\Option;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ResultExport implements FromView
{
   
    public function view(): View
    {
        $results = Result::with('user')
        ->whereNotNull('weighted_average')
        ->orderByDesc('measure_c_score')
        ->get();
        $option = Option::first();
        return view('exports.qualified-exam-report', ['results' => $results, 'option' => $option]);
            
     
       
    }
}
