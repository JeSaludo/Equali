<?php

namespace App\Exports;
use App\Models\Result;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class QualifiedISExport implements  FromView
{
  
    public function view(): View
    {
        $results = Result::with(['user', 'user.studentInfo'])
        ->whereNotNull('weighted_average')
        ->whereHas('user.studentInfo', function ($query) {
            $query->where('course', "IS")->where('status', 'Qualified');
        })
        ->orderByDesc('weighted_average')
        ->get();
        return view('exports.qualified-it', ['results' => $results]);
    }
}
