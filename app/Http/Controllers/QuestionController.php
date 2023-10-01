<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Question;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    function StoreQuestion(Request $request){

        $request->validate([
            'question_text' => 'required',
            'choice_text' => 'required|array',
            'choice_text.*' => 'required|string',
            'correct_choice' => 'required|numeric',           

        ]);
      

        $question = new Question();
        $question->question_text = $request->question_text;  
       
        $question->save();

        foreach ($request->choice_text as $key => $choiceText) {
           $isCorrect = ($request->correct_choice == ($key + 1));

           $choice = new Choice();
           $choice->question_id = $question->id;
           $choice->choice_text = $choiceText;
           $choice->is_correct = $isCorrect;
           $choice->save();
        }
        return redirect()->back()->with('success', 'Question added successfully!');
    }


    function ShowQuestions(){
        $questions  = Question::paginate(10);

        return view('admin.dashboard-view-question', compact('questions'));

    }

    function ShowAddQuestion()
    {
        return view('admin.dashboard-add-question');
    }

    public function ShowEditQuestion($id)
    {   
        // Fetch the question and its choices
        $question = Question::with('choices')->findOrFail($id);  
        return view('admin.dashboard-edit-question', compact('question'));
    }
    public function UpdateQuestion(Request $request,  $id)
    {
        $request->validate([
            'question_text' => 'required',
            'choice_text' => 'required|array',
            'choice_text.*' => 'required|string',
            'correct_choice' => 'required|numeric',
        ]);

        // Update the question details
       

        $question = Question::findOrFail($id);
        $question->question_text = $request->question_text;
        $question->save();
    
        // Delete existing choices for this question (optional)
        $question->choices()->delete();
    
        // Add/update choices
        foreach ($request->choice_text as $key => $choiceText) {
            $isCorrect = ($request->correct_choice == ($key + 1));
    
            $choice = new Choice();
            $choice->question_id = $question->id;
            $choice->choice_text = $choiceText;
            $choice->is_correct = $isCorrect;
            $choice->save();
        }
    
    
        return redirect()->route('admin.dashboard.view-question')->with('success', 'Question edited successfully!');
    }   

    public function DeleteQuestion($id){
        $question = Question::findOrFail($id);
        $question->choices()->delete();
        $question->delete();

        return redirect()->route('admin.dashboard.view-question')->with('success', 'Question remove successfully!');
    }


    public function ShowCreateExam(){
        return view('');
    }

}
