<?php

namespace App\Http\Controllers;

use App\Mail\ExamReports;
use App\Models\Choice;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamResponse;
use App\Models\Question;
use App\Models\Result;
use App\Models\StudentResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Jobs\SendExamReportEmail;

class ExamController extends Controller

{
    function ShowExam()
    {
       
     
        $user = User::where('id', Auth::user()->id)->with('studentInfo')->first();


        if($user->studentInfo){
            $exam = session('assigned_exam');

            if (!$exam) {
                // If not, randomly select an exam and store its identifier in the session
                $exam = Exam::inRandomOrder()->with('examQuestion.question.choices')->first();
                session(['assigned_exam' => $exam]);
            }            
            return view('student.exam', compact('exam'));
        }
        else{
            return redirect()->route('home')->with("error", "Error");
        }
       //$request->session()->forget('form_submitted');
       
    }

    function ShowAlreadyResponded(){
        return view('student.already-responded');
    }

    function SubmitExam(Request $request){

     
        if ($request->session()->get('form_submitted')) {
            // Form has already been submitted, handle the case
            return redirect()->route('student.already-responded');
        }

        DB::beginTransaction();
        try{     
           
            $userAnswers = $request->answer;
           
            $score = 0;
          
            $currentExamId = $request->exam_id;
        
            $currentExam = ExamQuestion::where('exam_id', $request->exam_id)->with('question.choices')->get();        
            $choices = Choice::all();
         
           

          
            foreach ($currentExam as $index => $exam) {
                $correctAnswer = $exam->question->correctAnswer(); // Make sure this method returns the correct answer 


                if (isset($userAnswers[$index + 1]) && $userAnswers[$index + 1] != "No Answer") {
                    ExamResponse::create([
                        'user_id' => auth()->id(),
                        'question_id' => $exam->question->id,
                        'choice_id' => $userAnswers[$index + 1],
                    ]);          
                
                    $choices = $choices->find($userAnswers[$index + 1]);
                }
                
            
                
                if(isset($userAnswers[$index + 1]) && $choices->choice_text === $correctAnswer){
                    $score++;                
                }
                
               
            
            }       

       
        
            $examScore = $score;

            $minScore = 0;    // Minimum score
            $maxScore = count($userAnswers);  // Maximum score
            $minValue = 1;    // Minimum value
            $maxValue = 5;  

            $score = min(max($score, $minScore), $maxScore);        
            $sizeOfScore = sizeOf($userAnswers);

            $range = $maxValue - $minValue;
            $scoreFraction = ($score - $minScore) / ($maxScore - $minScore);
            $scaledValue = $minValue + $range * $scoreFraction;
            $scaledValue = intval($scaledValue);        
            
            $result = Result::where('user_id', $request->user_id)->first();
            $result->measure_c_score = $scaledValue;
            
            $result->save();
            
            $result->weighted_average = ($result->measure_a_score + $result->measure_b_score + $result->measure_c_score) / 3;
            $result->save();
            $request->session()->put('form_submitted', true);

            $user = User::where('id', $request->user_id)->first();
            $user->status = "WaitListed";
            $user->save();

           
            
            DB::commit();
                     
            
        }
        catch (\Exception $e) {        
            DB::rollback(); 
           
            return redirect()->back()->with('error', 'Failed to submit exam. Please try again later.');
            // $request->session()->forget('form_submitted');
        }

        $userAnswers = $request->answer;
        $currentExamId = $request->exam_id;
    
        $currentExam = ExamQuestion::where('exam_id', $request->exam_id)->with('question.choices')->get();        
        $choices = Choice::all();
        $tempQuestion = [];
        
        foreach ($currentExam as $index => $exam)
        {
            if (isset($userAnswers[$index + 1])){
                $tempQuestion[$index]['question_text'] = $exam->question->question_text;
                $tempQuestion[$index]['choices'] = [];
    
                $correctAnswer = $exam->question->correctAnswer();
                $userChoice = $choices->find($userAnswers[$index + 1]);
          
            foreach ($exam->question->choices as $choice)
                
                    $tempQuestion[$index]['choices'][] = [
                        'choice_text' => $choice->choice_text,
                        'userChoice' => $userChoice->choice_text,
                        'is_correct' => ($choice->choice_text == $correctAnswer),
                    ];
            }
        }
  
        $user = User::find($request->user_id);
        $defaultEmail = "janerissaludo@gmail.com";   
        SendExamReportEmail::dispatch($defaultEmail, $user->first_name, $user->last_name, $tempQuestion);
        //Mail::to($this->defaultEmail)->send(new ExamReports($this->firstName, $this->lastName, $this->tempQuestion));
        return view('student.exam-result', compact('score', 'sizeOfScore'));
        
    }
  


    public function ShowAdminExam(){

        $exams = Exam::all();
        return view('admin.dashboard-exam', compact('exams'));
    }


    public function StoreExam(Request $request){
        
        $request->validate([
            'examName' => 'max:30',
            'description' => 'max:64',
        ]);
        

        $exam = new Exam();

        if($request->examName === null)
        {
            $exam->title =  'Untitled Exam';
            $exam->description = '';
        }   
        else{
            $exam->title =  $request->examName;
            $exam->description = $request->description;
        }
        $totalPoint = 10;//Default
        $passingPercentage = 40;
        $exam->num_of_question = $totalPoint;

        $exam->passing_score = ($totalPoint * $passingPercentage) / 100;
        $exam->save();
        return redirect()->back()->with('success', 'Question added successfully!');       

    }

    public function UpdateExam(Request $request, $id){
        
        $request->validate([
            'examName' => 'max:30',
             'numOfQuestion' => 'required',
             'description' => 'max:64',
        ]);
        

        $exam = Exam::findOrFail($id);

        if($request->examName === null)
        {
            $exam->title =  'Untitled Exam';
            $exam->description = '';
        }   
        else{
            $exam->title =  $request->examName;
            $exam->description = $request->description;
        }
      
        $passingPercentage = 40;
        $exam->num_of_question = $request->numOfQuestion;

        $exam->passing_score = ($request->numOfQuestion * $passingPercentage) / 100;
        $exam->save();
        return redirect()->route('admin.dashboard.edit-exam', ['id' => $id]);

    }

    public function EditExam(Request $request, $id){

        $exam = Exam::findOrFail($id);
        $examQuestions = ExamQuestion::where('exam_id', $id)->with('question.choices')->get();


        return view('admin.dashboard-edit-exam', compact('exam', 'examQuestions'));
    }

    public function DeleteExam($id){
        $exam = Exam::findOrFail($id);
        $exam->delete();

        return redirect()->back()->with('success', 'Exam deleted successfully!');      
    }
    
    public function storeRandomExam(Request $request, $id) {
        $existingQuestionIds = ExamQuestion::where('exam_id', $id)->pluck('question_id')->toArray();
    
        // Check if there are any available questions to add.
        $availableQuestionsCount = Question::where('category','Discard')->whereNotIn('id', $existingQuestionIds)->count();
    
        // Change the limit for the total number of questions.
        $exam = Exam::find($id);
        $maxTotalQuestions = $exam->num_of_question;
        $numOfQuestions = $request->numOfQuestions;
    
        // Check if there are enough available questions.
        if ($availableQuestionsCount < $numOfQuestions) {
            return "Not enough available questions to add.";
        }
    
        // Get the current total questions added.
        $totalQuestionsAdded = ExamQuestion::where('exam_id', $id)->count();
    
        // Calculate the remaining questions that can be added based on the maximum limit.
        $remainingQuestions = $maxTotalQuestions - $totalQuestionsAdded;
    
        // Ensure that the desired number of questions does not exceed the remaining limit.
        $numOfQuestionsToAdd = min($numOfQuestions, $remainingQuestions);
    
        // Initialize variables to keep track of the added question IDs.
        $addedQuestionIds = [];
    
        // Loop until you have added the desired number of unique random questions or until the total limit is reached.
        while (count($addedQuestionIds) < $numOfQuestionsToAdd) {
            // Get a random question that is not already in the exam.
            $randomQuestion = Question::where('category', '!=', 'Discard')
            ->inRandomOrder()
            ->whereNotIn('id', $existingQuestionIds)
            ->first();
        
    
            // Check if a valid random question is found.
            if ($randomQuestion) {
                // Create a new ExamQuestion record.
                $examQuestion = new ExamQuestion();
                $examQuestion->exam_id = $id;
                $examQuestion->question_id = $randomQuestion->id;
                $examQuestion->save();
    
                // Add the question ID to the list of added question IDs.
                $addedQuestionIds[] = $randomQuestion->id;
    
                // Update the $existingQuestionIds array to avoid adding the same question multiple times.
                $existingQuestionIds[] = $randomQuestion->id;
            } else {
                // Handle the case where there are no more unique questions to add.
                return "No Question to be added";
                break;
            }
        }
    
        // Check if the desired number of questions couldn't be added due to reaching the maximum limit.
        if (count($addedQuestionIds) < $numOfQuestions) {
            return "Cannot add more questions. Maximum limit reached.";
        }
    
        return redirect()->back()->with('success', 'Questions added successfully!');
    }
    

    function ShowQuestion($id){

        $exam_id = $id;

        $exam = Exam::find($id);
        $maxTotalQuestions = $exam->num_of_question;
        // Get the current total questions added.
        $totalQuestionsAdded = ExamQuestion::where('exam_id', $id)->count();
            
        // Calculate the remaining questions that can be added based on the maximum limit.
        $remainingQuestions = $maxTotalQuestions - $totalQuestionsAdded;

       

        if($remainingQuestions >= 1){

            return view('admin.dashboard-add-question-direct', compact('exam_id'));
        }
        else{
            return "Cannot add more questions. Maximum limit reached.";
        }


       
    }

    function StoreQuestionDirectly(Request $request){

      
        
        $img = $request->img;
        $request->validate([
            'question_text' => 'required',
            'choice_text' => 'required|array',
            'choice_text.*' => 'required|string',
            'correct_choice' => 'required|numeric',           

        ]);
      
            
        $question = new Question();
        $question->question_text = $request->question_text;  
       
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
        

        $examQuestion = new ExamQuestion();
        $examQuestion->exam_id = $request->exam_id;
        $examQuestion->question_id = $question->id;
        $examQuestion->save();

        return redirect()->route('admin.dashboard.edit-exam', $request->exam_id);
    }
    
   function StoreQuestionAndAddToExam(Request $request){

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

    
}

