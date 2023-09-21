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
        $question->category = $request->category;     
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
}
