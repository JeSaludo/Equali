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
        ->whereHas('user', function ($query) {
            $query->where('status', 'Qualified');
        })
        ->whereNotNull('weighted_average')
        ->orderByDesc('weighted_average')
        ->paginate(10);
        return view('exports.ranking-report', ['results' => $results]);
    }
}
