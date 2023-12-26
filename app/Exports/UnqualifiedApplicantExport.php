<?php

namespace App\Exports;
use App\Models\Result;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class UnqualifiedApplicantExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $results = Result::with('user')
        ->whereHas('user', function ($query) {
            $query->where('status', 'Unqualified');
        })
        ->whereNotNull('weighted_average')        
        ->get();
        
        return view('exports.ranking-report', ['results' => $results]);
    }
}
