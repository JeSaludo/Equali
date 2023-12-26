<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Result;
use App\Models\Question;
use App\Models\Choice;
use App\Models\ExamQuestion;
use App\Models\ExamResponse;
use App\Models\User;

class ItemAnalysisReport implements FromView
{
    protected $items;
    
    protected $selectedYear;
   
    public function __construct($items, $selectedYear)
    {
        $this->items = $items;
    
        $this->selectedYear = $selectedYear;
       
    }


    public function view(): View
    {
        return view('exports.item-analysis-report', ['items' => $this->items,  'selectedYear' => $this->selectedYear]);
    }
}
