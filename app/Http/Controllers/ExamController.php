<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\Question;
use App\Models\StudentResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
class ExamController extends Controller
{
    function ShowExam()
    {
        $randomExam = Exam::inRandomOrder()->with('examQuestion.question.choices')->first();

        if (!$randomExam) {
            // Handle the case where there are no exams available
            return "No exams available.";
        }     

        return view('student.exam', compact('randomExam'));
    }

    function SubmitExam(Request $request){

        $userAnswers = $request->answer;
        $score = 0;
    
        $correctAnswer = [];
        $userAnswer = [];

        $currentExamId = $request->exam_id;
      
        $currentExam = ExamQuestion::where('exam_id', $currentExamId)->with('question.choices')->get();
        
        foreach($currentExam as $index => $exam){
            
            $correctChoice = $exam->question->correctAnswer();
            $correctAnswer[$index] = $correctChoice;
            foreach($userAnswers  as $answerId => $answer){
                $userAnswer[$answerId] = $answer;
                if($answer === $exam->question->correctAnswer()){
                    $score++;
                }
            }
        }
    
        return "Your result is " .$score . "/" . sizeOf($userAnswers); 
        
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
}

