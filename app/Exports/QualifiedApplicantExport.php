<?php

namespace App\Exports;
use App\Models\Result;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class QualifiedApplicantExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $results = Result::with('user')//studentInfo
    ->whereHas('user', function ($query) {
        $query->where('status', 'Qualified');
    })
    ->whereNotNull('weighted_average')
    ->orderByDesc('weighted_average')->get();
        return view('exports.ranking-report', ['results' => $results]);
    }
}
