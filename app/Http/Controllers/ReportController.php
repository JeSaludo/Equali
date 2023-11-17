<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Result;
use App\Models\Question;
use App\Models\Choice;
use App\Models\ExamQuestion;
use App\Models\ExamResponse;

use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    

    public function ShowQualifyingExamResult(){

        // $users = User::where('role', 'Student')
        // ->with('result')
        // ->get();//can use result with student so it easy to use order by
        

        $results = Result::with('user')
        ->whereNotNull('weighted_average')
        ->orderByDesc('weighted_average')
        ->get();
        
        return view('admin.reports.qualifed-applicant-result', compact('results'));
    }

    public function ShowItemAnalysis(){
       
        // $examResponses = ExamResponse::all();
        // $groupedResponses = $examResponses->groupBy(['question_id', 'selected_answer']);
      
        $questions = Question::all(); // Fetch all questions

        // Eager load choices and student responses for all questions to avoid N+1 queries
        $questions->load('choices', 'examResponse');

       
     


        


        return view('admin.reports.item-analysis', compact('questions'));
    }


    
}




