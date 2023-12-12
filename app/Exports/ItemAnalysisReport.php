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
    protected $questions;
    protected $DI;


    public function __construct($questions, $DI)
    {
        $this->questions = $questions;
        $this->DI = $DI;
       
       
    }


    public function view(): View
    {
        return view('exports.item-analysis-report', ['questions' => $this->questions, 'DI' => $this->DI]);
    }
}
