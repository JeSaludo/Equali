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
        $questions  = Question::with('choices')->get();

        return view('student.exam', compact('questions'));
    }

    function SubmitExam(Request $request){

        $submittedAnswers = $request->input('answer');

        
        $score = 0;
    
       
        foreach ($submittedAnswers as $questionIndex => $submittedAnswer) {
            $question = Question::find($questionIndex); // Assuming Question model
            $correctAnswer = $question->correctAnswer(); // Implement this method in your Question model
            
            // Check if the submitted answer matches the correct answer
            if ($submittedAnswer === $correctAnswer) {
                $score++; // Increment the score
            }
        }
        dd($score);
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

    public function StoreRandomExam(Request $request, $id){

        $examId = $id;

        // Get the existing question IDs associated with the exam.
        $existingQuestionIds = ExamQuestion::where('exam_id', $examId)->pluck('question_id')->toArray();
        
        // Initialize an array to keep track of the added question IDs.
        $addedQuestionIds = [];
    
        // Loop until you have added 10 unique random questions.
        while (count($addedQuestionIds) < 2) {
            // Get a random question that is not already in the exam.
            $randomQuestion = Question::inRandomOrder()->whereNotIn('id', $existingQuestionIds)->first();
    
            // Check if a valid random question is found.
            if ($randomQuestion) {
                // Create a new ExamQuestion record.
                $examQuestion = new ExamQuestion();
                $examQuestion->exam_id = $examId;
                $examQuestion->question_id = $randomQuestion->id;
                $examQuestion->save();
    
                // Add the question ID to the list of added question IDs.
                $addedQuestionIds[] = $randomQuestion->id;
            } else {
                // Handle the case where there are no more unique questions to add.
                return "Already ADded";   
            }
        

            return "Done";     
    }}
}

