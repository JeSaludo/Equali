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
use App\Models\Option;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Jobs\SendExamReportEmail;
use App\Jobs\SendQualifyMail;
use App\Jobs\SendUnqualifyMail;
use App\Jobs\SendUnualifyMail;
use App\Mail\QualifyMail;
use App\Mail\UnqualifyMail;

class ExamController extends Controller

{
    function ShowExam(Request $request)
    {
        // $request->session()->forget('form_submitted');
        $user = User::where('id', Auth::user()->id)->first();

        if ($user->exam_taken === null) {
            $option = Option::first(); 
            if ($user->status === 'Ready For Exam') {
                $exam = session('assigned_exam');

                if (!$exam) {
                
                    // If not, randomly select an exam and store its identifier in the session
                    $exam = Exam::inRandomOrder()->with('examQuestion.question.choices')->first();
                    
                 
                    if ($exam && $exam->examQuestion->count() == $option->qualifying_number_of_items) {
                        session(['assigned_exam' => $exam]);
                    }
                    
                    else {
                        // Handle the case where no suitable exam is found
                        return redirect()->route('home')->with('error', 'No qualifying exam found.');
                    }
                      

                    //return redirect()->route('home')->with('error', 'Exam has not been set, Please try again later');
                
                }            

            
                return view('student.exam', compact('exam', 'option'));
            }
            else{
                return redirect()->route('home')->with("error", "You must be interviewed first before you take the exam!");
            }
        }else{
            return redirect()->route('home')->with("error", "You have already taken the exam!");
        }
       
        
       

       
    }

    function ShowAlreadyResponded(){
        return view('student.already-responded');
    }

    function SubmitExam(Request $request){  

            
            $user = User::find(Auth::user()->id);

            if($user->exam_taken == null){
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
                    $result->total_exam_score = $score;
                    //$result->scaled_exam_score = $scaledValue;
                    $result->measure_c_score = $scaledValue * 0.4;
                    
                    $result->save();
                    
                    $result->weighted_average = ($result->measure_a_score + $result->measure_b_score + $result->measure_c_score) / 3;
                    $result->save();
                    $request->session()->put('form_submitted', true);
        
                    $option = Option::first();
                    $user = User::where('id', $request->user_id)->first();
    
                    $user->exam_taken = 1;

                    $qualifiedCount = User::where('role', 'Student')->where('status', 'Qualified')->count();

                    if ($qualifiedCount < $option->number_of_qualified) {
                        if ($result->weighted_average >= $option->qualified_student_passing_average) {
                            $user->status = "Qualified";
                            //SendQualifyMail::dispatch($user->email, $user->first_name, $user->last_name);
                            Mail::to($user->email)->send(new QualifyMail( $user->first_name,$user->last_name));
                        } else {
                            $user->status = "Unqualified";
                            //SendUnqualifyMail::dispatch($user->email, $user->first_name, $user->last_name);
                            //Mail::to($user->email)->send(new UnqualifyMail( $user->first_name,$user->last_name));
        
                        }
                    } else {

                        if ($result->weighted_average >= $option->qualified_student_passing_average) {
                            $user->status = "WaitListed";
                            // SendQualifyMail::dispatch($user->email, $user->first_name, $user->last_name);
                        } else {
                            $user->status = "Unqualified";
                            //SendUnqualifyMail::dispatch($user->email, $user->first_name, $user->last_name);
                           // Mail::to($user->email)->send(new UnqualifyMail( $user->first_name,$user->last_name));
        
                        }
                       
                    }

                    
                   
                    $user->save();
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
                    
                    
                    $deans = User::where('role', 'Dean')->get();
        
                    foreach($deans as $dean){
                        //SendExamReportEmail::dispatch($dean->email, $user->first_name, $user->last_name, $tempQuestion);
                        Mail::to($this->$dean->email)->send(new ExamReports($user->first_name,  $user->last_name, $tempQuestion));
                   
                    }
                        
                    DB::commit();
    
                    $option = Option::first();
                    return view('student.exam-result', compact('score', 'sizeOfScore', 'option'));
                    
                
                    
                }
                catch (\Exception $e) {
                  //  Log::error('Failed to submit exam. Error: ' . $e->getMessage());
                    DB::rollback();
                    return redirect()->back()->with('error', 'Failed to submit exam. Please try again later.' . $e->getMessage());
                }
                
            }
            else{
                return redirect()->route('home')->with("error", "You have already taken the exam!");
            }

          
          
     
      
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
      
        $exam->save();
        return redirect()->back()->with('success', 'Exam added successfully!');       

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
      
       
        $exam->save();
        return redirect()->route('admin.dashboard.edit-exam', ['id' => $id]);

    }

    public function EditExam(Request $request, $id){

        $exam = Exam::findOrFail($id);
        $examQuestions = ExamQuestion::where('exam_id', $id)->with('question.choices')->get();

        $option = Option::first();
        return view('admin.dashboard-edit-exam', compact('exam', 'examQuestions','option'));
    }

    public function DeleteExam($id){
        $exam = Exam::findOrFail($id);
        $exam->delete();

        return redirect()->back()->with('success', 'Exam deleted successfully!');      
    }
    
    public function storeRandomExam(Request $request, $id) {
        $examId = $id;
    
        $option = Option::first();
        $maxQuestionsAllowed = $option->qualifying_number_of_items;
    
        $exam = Exam::find($examId);
    
        $existingQuestionIds = $exam->examQuestion()->pluck('question_id')->toArray();
    
        $remainingSlots = $maxQuestionsAllowed - count($existingQuestionIds);
    
        if ($remainingSlots <= 0) {
            return redirect()->back()->with('error', 'Maximum number of questions already added.');
        }
    

        $existingQuestionIdsInCurrentExam = DB::table('exam_questions')
            ->where('exam_id', $examId)
            ->pluck('question_id')
            ->toArray();
        
        
        $existingQuestionIdsInOtherExams = DB::table('exam_questions')
            ->whereIn('question_id', function ($query) use ($examId) {
                $query->select('question_id')
                    ->from('exam_questions')
                    ->where('exam_id', '!=', $examId);
            })
            ->pluck('question_id')
            ->toArray();
     

   
            if ($remainingSlots > 0) {
                $newQuestions = Question::inRandomOrder()
                    ->whereNotIn('id', array_merge($existingQuestionIdsInCurrentExam, $existingQuestionIdsInOtherExams))
                    ->limit($remainingSlots)
                    ->get();
            
                // Check if any new questions were added
                if ($newQuestions->count() > 0) {
                    foreach ($newQuestions as $question) {
                        ExamQuestion::create([
                            'exam_id' => $examId,
                            'question_id' => $question->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
            
                    return redirect()->back()->with('success', 'New questions added successfully!');
                } else {
                    return redirect()->back()->with('error', 'No new questions were added.');
                }
            } else {
                return redirect()->back()->with('error', 'Not enough remaining slots to add new questions.');
            }
    }
    
    
    
    function ShowQuestion($id){

        $exam_id = $id;

        $exam = Exam::find($id);
        $option = Option::first();
        $maxTotalQuestions = $option->qualifying_number_of_items;
        // Get the current total questions added.
        $totalQuestionsAdded = ExamQuestion::where('exam_id', $id)->count();
            
        // Calculate the remaining questions that can be added based on the maximum limit.
        $remainingQuestions = $maxTotalQuestions - $totalQuestionsAdded;

       

        if($remainingQuestions >= 1){

            return view('admin.dashboard-add-question-direct', compact('exam_id'));
        }
        else{
            
           
            return redirect()->back()->with('error', 'Cannot add more questions. Maximum limit reached.');
        }


       
    }
    // $numOfQuestions = $request->numOfQuestions;
    //     $examId = $id;
        
    //     $option = Option::first();
    //     // Get the maximum allowed number of questions for the exam (assuming you have a max_questions field in your exams table)
    //     $maxQuestionsAllowed = $option->qualifying_number_of_items;
        
    //     // Get questions that are already associated with the current exam
    //     $existingQuestionIdsInCurrentExam = DB::table('exam_questions')
    //         ->where('exam_id', $examId)
    //         ->pluck('question_id')
    //         ->toArray();
        
    //     // Get questions that are associated with other exams
    //     $existingQuestionIdsInOtherExams = DB::table('exam_questions')
    //         ->whereIn('question_id', function ($query) use ($examId) {
    //             $query->select('question_id')
    //                 ->from('exam_questions')
    //                 ->where('exam_id', '!=', $examId);
    //         })
    //         ->pluck('question_id')
    //         ->toArray();
        
    //     // Calculate the available slots for new questions
    //     $availableSlots = $maxQuestionsAllowed - count($existingQuestionIdsInCurrentExam);
        
    //     // Check if the requested number of questions exceeds the available slots
    //     if ($numOfQuestions > $availableSlots + 1) {
    //         // Redirect back with an error message
           
            
    //         return redirect()->back()->with('error', 'Failed to add questions. Maximum number of questions allowed is ' . $maxQuestionsAllowed );
    //     }
        
    //     // Get random question ids excluding those already associated with the current exam or other exams
    //     $randomQuestionIds = Question::whereNotIn('id', array_merge($existingQuestionIdsInCurrentExam, $existingQuestionIdsInOtherExams))
    //         ->inRandomOrder()
    //         ->take($numOfQuestions)
    //         ->pluck('id')
    //         ->toArray();
        
    //     // Check if any selected question is already associated with the current exam or other exams
    //     if (count($randomQuestionIds) < $numOfQuestions) {
    //         $unavailableQuestions = array_merge($existingQuestionIdsInCurrentExam, $existingQuestionIdsInOtherExams);
        
    //         // Redirect back with a specific error message
    //         return redirect()->back()->with('error', 'Failed to add questions. Some questions are already associated with a certain exam');
    //     }
        
    //     // Insert records into the exam_questions pivot table
    //     foreach ($randomQuestionIds as $questionId) {
    //         DB::table('exam_questions')->insert([
    //             'exam_id' => $examId,
    //             'question_id' => $questionId,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     }
        
    //     // Redirect back with a success message
    //     return redirect()->back()->with('success', 'Questions added successfully!');
        

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
        $question->year =  date('Y');
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

        $choice = new Choice();
        $choice->question_id = $question->id;
        $choice->choice_text = "No Answer";
        $choice->is_correct = false;
        $choice->save();
        return redirect()->back()->with('success', 'Question added successfully!');
    }



    
}

