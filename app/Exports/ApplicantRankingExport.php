<?php

namespace App\Exports;

use App\Models\Result;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class ApplicantRankingExport implements FromView
{
   
    public function view(): View
    {
        $results = Result::with('user')
        ->whereNotNull('weighted_average')
        ->orderByDesc('weighted_average')
        ->get();
        return view('exports.ranking-report', ['results' => $results]);
    }
}
