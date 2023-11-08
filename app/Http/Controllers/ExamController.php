<?php

namespace App\Http\Controllers;

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
class ExamController extends Controller
{
    function ShowExam()
    {
       
        $exam = session('assigned_exam');

        if (!$exam) {
            // If not, randomly select an exam and store its identifier in the session
            $exam = Exam::inRandomOrder()->with('examQuestion.question.choices')->first();
            session(['assigned_exam' => $exam]);
        }
        
        return view('student.exam', compact('exam'));
    }

    function ShowAlreadyResponded(){
        return view('student.already-responded');
    }
    function SubmitExam(Request $request){

        
        if ($request->session()->get('form_submitted')) {
            // Form has already been submitted, handle the case
            return redirect()->route('student.already-responded');
        }
        $userAnswers = $request->answer;
       
        
        $score = 0;

        $currentExamId = $request->exam_id;
      
         $currentExam = ExamQuestion::where('exam_id', $request->exam_id)->with('question.choices')->get();        
        
       
        foreach ($currentExam as $index => $exam) {
            $correctAnswer = $exam->question->correctAnswer(); // Make sure this method returns the correct answer 

            ExamResponse::create([
                'question_id' => $exam->question->id,
                'answer' => $userAnswers[$index + 1],
            ]);
        
            if (isset($userAnswers[$index + 1]) && $userAnswers[$index + 1] === $correctAnswer) {
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
       // $request->session()->forget('form_submitted');
        return $this->showExamResult($score, $sizeOfScore);
    }
    public function ShowExamResult($score, $sizeOfScore) {
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
        $totalPoint = 10;
        $passingPercentage = 40;
        $exam->num_of_question = $totalPoint;

        $exam->passing_score = ($totalPoint * $passingPercentage) / 100;
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
    
    public function StoreRandomExam(Request $request, $id){
 
        $existingQuestionIds = ExamQuestion::where('exam_id', $id)->pluck('question_id')->toArray();

        // Check if there are any available questions to add.
        $availableQuestionsCount = Question::whereNotIn('id', $existingQuestionIds)->count();

        if ($availableQuestionsCount < 5) {
            return "Not enough available questions to add.";
        }

        // Initialize an array to keep track of the added question IDs.
        $addedQuestionIds = [];

        // Loop until you have added 5 unique random questions or until no more questions are available.
        while (count($addedQuestionIds) < 5) {
            // Get a random question that is not already in the exam.
            $randomQuestion = Question::inRandomOrder()
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
                break;
            }
        }

        return redirect()->back()->with('success', 'Question added successfully!');       
            
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

