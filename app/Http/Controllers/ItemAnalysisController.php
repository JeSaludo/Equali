<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Result;
use App\Models\Question;
use App\Models\Choice;
use App\Models\ExamQuestion;
use App\Models\ExamResponse;
use App\Models\ItemAnalysisReport;
use App\Models\User;

class ItemAnalysisController extends Controller
{
    public function GenerateItemAnalysis() {
        $DI = [];
        $questions = Question::all();
    
        foreach ($questions as $index => $question) {
            $hasResponses = $question->examResponse()->exists();
    
            if ($hasResponses && $question->examResponse()->count() > 1) {
                $choices = $question->choices;
                $correctChoice = $choices->where('is_correct', true)->first();
                $correctChoiceId = $correctChoice->id;
                $responses = ExamResponse::where('question_id', $question->id)->get();
                $totalResponses = $responses->count();
                $correctResponses = $responses->where('choice_id', $correctChoiceId)->count();
                $di = round($correctResponses / $totalResponses, 2);
                $DI[$index] = $di;
    
                // Store the item analysis report in the database
                ItemAnalysisReport::updateOrCreate([
                    'question_id' => $question->id,
                    'di' => $di,
                    'year' => $question->year,
                ]);
    
                if ($di < 0.15) {
                    $question->category = "Discard";
                    $question->save();
                    $question->update(['category' => 'Discard']);
                    ExamQuestion::where('question_id', $question->id)->delete();
                } elseif ($di >= 0.15 && $di < 0.3) {
                    $question->update(['category' => 'Revise']);
                } elseif ($di >= 0.3 && $di < 0.71) {
                    $question->update(['category' => 'Retain']);
                } elseif ($di >= 0.71 && $di < 0.86) {
                    $question->update(['category' => 'Revise']);
                } elseif ($di >= 0.86) {
                    $question->category = "Discard";
                    $question->save();
                    $question->update(['category' => 'Discard']);
                    ExamQuestion::where('question_id', $question->id)->delete();
                }
            }
        }
    
        return redirect()->back()->with('success', 'Analyze items successfully!');
    }
    

    public function ShowItemAnalysisAll(Request $request){
        $questionCount = Question::all();
        $DI = [];
        $uniqueYears = Question::distinct()->pluck('year')->toArray();
        $selectedYear = $request->selected_year;
        
      
        
        $questions = Question::where('category'); 
        
        if (isset($selectedYear)) {
            $questions->where('year', $selectedYear);
        }
        
        $questions = $questions->get();
        foreach ($questions as $index => $question) {
            // Check if there are exam responses for the current question
            $hasResponses = $question->examResponse()->exists();
            
            
            if($question->examResponse()->count() > 1)
            {
                if ($hasResponses) {
                    $choices = $question->choices;
    
                    $correctChoice = $choices->where('is_correct', true)->first();
                    $correctChoiceId = $correctChoice->id;
                    $responses = ExamResponse::where('question_id', $question->id)->get();
                    $totalResponses = $responses->count();
                    $correctResponses = $responses->where('choice_id', $correctChoiceId)->count();   
                    $di = round($correctResponses / $totalResponses, 2);
                    $DI[$index] = $di;
                }
              
            }            

          
        }

       
        return view('admin.reports.item-analysis-all', compact('questions', 'DI','questionCount','uniqueYears', 'selectedYear'));
    }
    
    public function ShowItemAnalysisRevise(Request $request){
        $questionCount = Question::all();
        $DI = [];
        $uniqueYears = Question::distinct()->pluck('year')->toArray();
        $selectedYear = $request->selected_year;
        
     
        
        $questions = Question::where('category','Revise');
        
        if (isset($selectedYear)) {
            $questions->where('year', $selectedYear);
        }
        
        $questions = $questions->get();
        foreach ($questions as $index => $question) {
            // Check if there are exam responses for the current question
            $hasResponses = $question->examResponse()->exists();
           
            if($question->examResponse()->count() > 0)
            // {
                if ($hasResponses) {
                    $choices = $question->choices;
    
                    $correctChoice = $choices->where('is_correct', true)->first();
                    $correctChoiceId = $correctChoice->id;
                    $responses = ExamResponse::where('question_id', $question->id)->get();
                    $totalResponses = $responses->count();
                    $correctResponses = $responses->where('choice_id', $correctChoiceId)->count();   
                    $di = round($correctResponses / $totalResponses, 2);
                    $DI[$index] = $di;
                }
                
             }            
        

       
        return view('admin.reports.item-analysis-revise', compact('questions', 'DI','questionCount','uniqueYears', 'selectedYear'));
    }
    public function ShowItemAnalysisRetain(Request $request){
        $questionCount = Question::all();
        $DI = [];
        $uniqueYears = Question::distinct()->pluck('year')->toArray();
        $selectedYear = $request->selected_year;
        
      
       
        $questions = Question::where('category','Retain');
        
        if (isset($selectedYear)) {
            $questions->where('year', $selectedYear);
        }
        
        $questions = $questions->get();
        foreach ($questions as $index => $question) {
            // Check if there are exam responses for the current question
            $hasResponses = $question->examResponse()->exists();
           
    
            if($question->examResponse()->count() > 1)
            {
                if ($hasResponses) {
                    $choices = $question->choices;
    
                    $correctChoice = $choices->where('is_correct', true)->first();
                    $correctChoiceId = $correctChoice->id;
                    $responses = ExamResponse::where('question_id', $question->id)->get();
                    $totalResponses = $responses->count();
                    $correctResponses = $responses->where('choice_id', $correctChoiceId)->count();   
                    $di = round($correctResponses / $totalResponses, 2);
                    $DI[$index] = $di;
                }
            }            
        }

       
        return view('admin.reports.item-analysis-retain', compact('questions', 'DI','questionCount','uniqueYears', 'selectedYear'));
    }

    public function ShowItemAnalysisDiscard(Request $request){
        $questionCount = Question::all();
        $DI = [];
        $uniqueYears = Question::distinct()->pluck('year')->toArray();
        $selectedYear = $request->selected_year;
      
        
     
        $questions = Question::where('category','Discard');
        if (isset($selectedYear)) {
            $questions->where('year', $selectedYear);
        }
        
        $questions = $questions->get();
        foreach ($questions as $index => $question) {
            // Check if there are exam responses for the current question
            $hasResponses = $question->examResponse()->exists();
         
            if($question->examResponse()->count() > 1)
            {
                if ($hasResponses) {
                    $choices = $question->choices;
    
                    $correctChoice = $choices->where('is_correct', true)->first();
                    $correctChoiceId = $correctChoice->id;
                    $responses = ExamResponse::where('question_id', $question->id)->get();
                    $totalResponses = $responses->count();
                    $correctResponses = $responses->where('choice_id', $correctChoiceId)->count();   
                    $di = round($correctResponses / $totalResponses, 2);
                    $DI[$index] = $di;
                }
            }            
        }

       
        return view('admin.reports.item-analysis-discard', compact('questions', 'DI','questionCount','uniqueYears', 'selectedYear'));
    }
}
