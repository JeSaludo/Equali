<?php

namespace App\Http\Controllers;
use App\Models\ExamQuestion;
use App\Models\User;
use App\Models\Choice;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    function StoreQuestion(Request $request){

        $img = $request->img;
        

        $request->validate([
            'question_text' => 'required|unique:questions,question_text',

            'choice_text' => 'required|array',
            'choice_text.*' => 'required|string',
            'correct_choice' => 'required|numeric',           

        ]);
        DB::beginTransaction();
        try{

            $question = new Question();
            $question->question_text = $request->question_text;  
            $currentYear = date('Y'); 
            $question->year =  $currentYear;
            $question->save();
    
            if(!is_null($img)){                        
    
                if ($question->image_path) {
                    Storage::delete('public/questions/' . $question->image_path);
                }
                
                $extension = $img->getClientOriginalExtension();
                $newFileName = 'question-image_' . $question->id . '.' . $extension;
    
                $path = $request->file('img')->storeAs('public/questions', $newFileName);           
                   
                $question->image_path = $newFileName;
                $question->save();
            }
    
            foreach ($request->choice_text as $key => $choiceText) {
               $isCorrect = ($request->correct_choice == ($key + 1));
               $choice = new Choice();
               $choice->question_id = $question->id;
               $choice->choice_text = $choiceText;
               $choice->is_correct = $isCorrect;
               $choice->save();
            }
            
            $choice = new Choice();
            $choice->question_id = $question->id;
            $choice->choice_text = "No Answer";
            $choice->is_correct = false;
            $choice->save();
            
            
            DB::commit();

            return redirect()->route('admin.dashboard.view-question')->with('success', 'Question added successfully!');      ;
        }
        catch (\Exception $e) {        
            DB::rollback(); 
           
            return redirect()->back()->with('error', 'Failed to create question. Please try again later.');
            // $request->session()->forget('form_submitted');
        }
      
    }
    

    function ShowQuestionReadOnly($id){
        $question = Question::with('choices')->findOrFail($id);  
      
       return view('admin.dashboard-view-read-only-question', compact('question'));
    }
    function ShowQuestions(){

        $questionCount = Question::all();
        $questions  = Question::paginate(10);

        return view('admin.dashboard-view-question', compact('questionCount', 'questions'));

    }

    function ShowRetainQuestions(){
        $questionCount = Question::all(); 
        $questions  = Question::where('category', 'Retain')->paginate(10);

        return view('admin.dashboard-view-question-retain', compact('questionCount', 'questions'));

    }

    function ShowDiscardQuestions(){

        $questionCount = Question::all();
        $questions  = Question::where('category', 'Discard')->paginate(10);

        return view('admin.dashboard-view-question-discard', compact('questionCount', 'questions'));

    }

    public function ShowAddQuestion()
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

        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $newFileName = 'question-image_' . $question->id . '.' . $img->getClientOriginalExtension();
            
            // Store the new image and replace the existing image
            $path = $img->storeAs('public/questions', $newFileName);
            $question->image_path = $newFileName;
        }
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

        $choice = new Choice();
        $choice->question_id = $question->id;
        $choice->choice_text = "No Answer";
        $choice->is_correct = false;
        $choice->save();
        
    
    
        return redirect()->route('admin.dashboard.view-question')->with('success', 'Question edited successfully!');
    }   
  

   
    public function DeleteQuestion($id){
        $question = Question::findOrFail($id);
       
     
        $question->category = "Discard";
        $question->save();

        ExamQuestion::where('question_id', $id)->delete();
        return redirect()->route('admin.dashboard.view-question')->with('success', 'Question discarded successfully!');
    }


    

}
