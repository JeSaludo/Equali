<?php

namespace App\Http\Controllers;
use App\Exports\UnqualifiedApplicantExport;
use App\Exports\QualifiedApplicantExport;
use App\Exports\ApplicantRankingExport;
use App\Exports\ItemAnalysisReport;
use App\Exports\ResultExport;
use Illuminate\Http\Request;

use App\Models\Option;
use App\Models\Result;
use App\Models\Question;
use App\Models\Choice;
use App\Models\ExamQuestion;
use App\Models\ExamResponse;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



class ReportController extends Controller
{
    public function ShowQualifyingExam(Request $request){

        
        $results = Result::with('user')->whereNotNull('weighted_average')->orderByDesc('total_exam_Score');
        
        $searchTerm = $request->input('searchTerm');
        if (!empty($searchTerm)) {
            $results->join('users', 'results.user_id', '=', 'users.id')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('users.first_name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('users.last_name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('measure_c_score', 'like', '%' . $searchTerm . '%');
                   
                });
        }      

      

        $results = $results->paginate(10);
        $option = Option::first();
        

        return view('admin.reports.list-of-qualifying-exam', compact('results', 'option'));
    }

    public function ShowQualifyingRankingResult(){

        // $users = User::where('role', 'Student')
        // ->with('result')
        // ->get();//can use result with student so it easy to use order by
       

        $results = Result::with('user')
        ->whereNotNull('weighted_average')
        ->orderByDesc('weighted_average');

        $results = $results->paginate(10);
        
        return view('admin.reports.qualified-applicants-ranking', compact('results'));
    }

    public function ShowQualifyingRankingResultIS(){

        // $users = User::where('role', 'Student')
        // ->with('result')
        // ->get();//can use result with student so it easy to use order by
       

        $results = Result::with(['user', 'user.studentInfo'])
        ->whereNotNull('weighted_average')
        ->whereHas('user.studentInfo', function ($query) {
            $query->where('course', "IS")->where('status', 'Qualified');
        })
        ->orderByDesc('weighted_average')
        ->paginate(10);
    
        return view('admin.reports.qualified-applicants-ranking-is', compact('results'));
    }

    public function ShowQualifyingRankingResultIT(){

        // $users = User::where('role', 'Student')
        // ->with('result')
        // ->get();//can use result with student so it easy to use order by
       
        $results = Result::with(['user', 'user.studentInfo'])
        ->whereNotNull('weighted_average')
        ->whereHas('user.studentInfo', function ($query) {
            $query->where('course', "IT")->where('status', 'Qualified');
        })
        ->orderByDesc('weighted_average')
        ->paginate(10);

        
        
        return view('admin.reports.qualified-applicants-ranking-it', compact('results'));
    }
   
    public function ShowItemAnalysisChart(){
       
        
        $questions = Question::orderBy('id', 'asc')->get();
      
        $questions->load('choices', 'examResponse');

        return view('admin.reports.item-analysis-chart', compact('questions'));
    }

       
        


    public function ShowItemAnalysis(){   
        $DI = [];
        $DS = [];
        $questionCount = Question::all();
        $questions = Question::where('category')->paginate(10);

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
    
                    // Calculate the percentage of correct responses
                    $percentageCorrect = ($totalResponses > 0) ? ($correctResponses / $totalResponses) * 100 : 0;
    
                    $totalStudents = User::where("Role", "Student")->count();
    
                    $percentileThreshold = 27; // Change this to the desired percentile
    
                    // Calculate the number of users required for each percentile
                    $upperPercentileCount = ceil(($percentileThreshold / 100) * $totalResponses);
                    $lowerPercentileCount = ceil(($percentileThreshold / 100) * $totalResponses); // Set the lower count to the same as the upper count
                    $middlePercentileCount = $totalResponses - 2 * $upperPercentileCount; // Remaining for the middle
    
                    // Retrieve upper threshold users based on the weighted average
                    $upperThresholdUsers = Result::join('users', 'results.user_id', '=', 'users.id')
                        ->orderByDesc('results.measure_c_score')
                        ->select('users.*', 'results.measure_c_score')
                        ->take($upperPercentileCount)
                        ->get();
    
                    // Retrieve middle threshold users based on the weighted average
                    $middleThresholdUsers = Result::join('users', 'results.user_id', '=', 'users.id')
                        ->orderByDesc('results.measure_c_score')
                        ->skip($upperPercentileCount)
                        ->take($middlePercentileCount)
                        ->select('users.*', 'results.measure_c_score')
                        ->get();
    
                    // Retrieve lower threshold users based on the weighted average
                    $lowerThresholdUsers = Result::join('users', 'results.user_id', '=', 'users.id')
                        ->orderBy('results.measure_c_score')  // Order in ascending order for lower threshold
                        ->take($lowerPercentileCount)
                        ->select('users.*', 'results.measure_c_score')
                        ->get();
    
                    // Separate responses of the threshold users
                    $upperThresholdUserResponses = $responses->whereIn('user_id', $upperThresholdUsers->pluck('id'));
                    $middleThresholdUserResponses = $responses->whereIn('user_id', $middleThresholdUsers->pluck('id'));
                    $lowerThresholdUserResponses = $responses->whereIn('user_id', $lowerThresholdUsers->pluck('id'));
    
                    // Count correct responses for upper threshold users
                    $totalUpperCorrectResponses = $upperThresholdUserResponses->where('choice_id', $correctChoiceId)->count();
    
                    // Count correct responses for middle threshold users
                    $totalMiddleCorrectResponses = $middleThresholdUserResponses->where('choice_id', $correctChoiceId)->count();
    
                    // Count correct responses for lower threshold users
                    $totalLowerCorrectResponses = $lowerThresholdUserResponses->where('choice_id', $correctChoiceId)->count();
    
                
                    // Calculate Discrimination Index for the upper, middle, and lower threshold users
                    // $totalUpperThresholdUserResponses = $upperThresholdUserResponses->count();
                    // $totalMiddleThresholdUserResponses = $middleThresholdUserResponses->count();
                    // $totalLowerThresholdUserResponses = $lowerThresholdUserResponses->count();
                    // $totalOtherUsersResponses = $totalResponses - $totalUpperThresholdUserResponses - $totalMiddleThresholdUserResponses - $totalLowerThresholdUserResponses;
    
                    // Calculate the discrimination index
                    $di = number_format($correctResponses / $totalResponses, 2);
                   
                    $N = round(($totalUpperCorrectResponses - $totalLowerCorrectResponses) / $totalResponses, 2);
                    $DI[$index] = $di;
                    $DS[$index] = $N;
                }
            }
        }
        return view('admin.reports.item-analysis-all', compact('questions', 'DI', 'DS','questionCount'));
   } 

   public function ShowItemAnalysisRetain(){   
        $DI = [];
        $DS = [];
        $questionCount = Question::all();
        $questions = Question::where('category', 'Retain')->paginate(10);

        
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

                    // Calculate the percentage of correct responses
                    $percentageCorrect = ($totalResponses > 0) ? ($correctResponses / $totalResponses) * 100 : 0;

                    $totalStudents = User::where("Role", "Student")->count();

                    $percentileThreshold = 27; // Change this to the desired percentile

                    // Calculate the number of users required for each percentile
                    $upperPercentileCount = ceil(($percentileThreshold / 100) * $totalResponses);
                    $lowerPercentileCount = ceil(($percentileThreshold / 100) * $totalResponses); // Set the lower count to the same as the upper count
                    $middlePercentileCount = $totalResponses - 2 * $upperPercentileCount; // Remaining for the middle

                    // Retrieve upper threshold users based on the weighted average
                    $upperThresholdUsers = Result::join('users', 'results.user_id', '=', 'users.id')
                        ->orderByDesc('results.measure_c_score')
                        ->select('users.*', 'results.measure_c_score')
                        ->take($upperPercentileCount)
                        ->get();

                    // Retrieve middle threshold users based on the weighted average
                    $middleThresholdUsers = Result::join('users', 'results.user_id', '=', 'users.id')
                        ->orderByDesc('results.measure_c_score')
                        ->skip($upperPercentileCount)
                        ->take($middlePercentileCount)
                        ->select('users.*', 'results.measure_c_score')
                        ->get();

                    // Retrieve lower threshold users based on the weighted average
                    $lowerThresholdUsers = Result::join('users', 'results.user_id', '=', 'users.id')
                        ->orderBy('results.measure_c_score')  // Order in ascending order for lower threshold
                        ->take($lowerPercentileCount)
                        ->select('users.*', 'results.measure_c_score')
                        ->get();

                    // Separate responses of the threshold users
                    $upperThresholdUserResponses = $responses->whereIn('user_id', $upperThresholdUsers->pluck('id'));
                    $middleThresholdUserResponses = $responses->whereIn('user_id', $middleThresholdUsers->pluck('id'));
                    $lowerThresholdUserResponses = $responses->whereIn('user_id', $lowerThresholdUsers->pluck('id'));

                    // Count correct responses for upper threshold users
                    $totalUpperCorrectResponses = $upperThresholdUserResponses->where('choice_id', $correctChoiceId)->count();

                    // Count correct responses for middle threshold users
                    $totalMiddleCorrectResponses = $middleThresholdUserResponses->where('choice_id', $correctChoiceId)->count();

                    // Count correct responses for lower threshold users
                    $totalLowerCorrectResponses = $lowerThresholdUserResponses->where('choice_id', $correctChoiceId)->count();

                
                    // Calculate Discrimination Index for the upper, middle, and lower threshold users
                    // $totalUpperThresholdUserResponses = $upperThresholdUserResponses->count();
                    // $totalMiddleThresholdUserResponses = $middleThresholdUserResponses->count();
                    // $totalLowerThresholdUserResponses = $lowerThresholdUserResponses->count();
                    // $totalOtherUsersResponses = $totalResponses - $totalUpperThresholdUserResponses - $totalMiddleThresholdUserResponses - $totalLowerThresholdUserResponses;

                    // Calculate the discrimination index
                    $di = round(($correctResponses) / $totalResponses);

                    $N = round(($totalUpperCorrectResponses - $totalLowerCorrectResponses) / $totalResponses, 2);
                    $DI[$index] = $di;
                    $DS[$index] = $N;
                }
            }
        
            
            
            
            
            }
        return view('admin.reports.item-analysis-retain', compact('questions', 'DI', 'DS', 'questionCount'));
    } 
    
    public function ShowItemAnalysisRevise(){   
        $DI = [];
        $DS = [];
        $questionCount = Question::all();
        $questions = Question::where('category', 'Revise')->paginate(10);

        
        foreach ($questions as $index => $question) {
            // Check if there are exam responses for the current question
            $hasResponses = $question->examResponse()->exists();

            if($question->examResponse()->count() >  1)
            {
                if ($hasResponses) {
                    $choices = $question->choices;

                    $correctChoice = $choices->where('is_correct', true)->first();
                    $correctChoiceId = $correctChoice->id;

                    $responses = ExamResponse::where('question_id', $question->id)->get();

                    $totalResponses = $responses->count();
                    $correctResponses = $responses->where('choice_id', $correctChoiceId)->count();

                    // Calculate the percentage of correct responses
                    $percentageCorrect = ($totalResponses > 0) ? ($correctResponses / $totalResponses) * 100 : 0;

                    $totalStudents = User::where("Role", "Student")->count();

                    $percentileThreshold = 27; // Change this to the desired percentile

                    // Calculate the number of users required for each percentile
                    $upperPercentileCount = ceil(($percentileThreshold / 100) * $totalResponses);
                    $lowerPercentileCount = ceil(($percentileThreshold / 100) * $totalResponses); // Set the lower count to the same as the upper count
                    $middlePercentileCount = $totalResponses - 2 * $upperPercentileCount; // Remaining for the middle

                    // Retrieve upper threshold users based on the weighted average
                    $upperThresholdUsers = Result::join('users', 'results.user_id', '=', 'users.id')
                        ->orderByDesc('results.measure_c_score')
                        ->select('users.*', 'results.measure_c_score')
                        ->take($upperPercentileCount)
                        ->get();

                    // Retrieve middle threshold users based on the weighted average
                    $middleThresholdUsers = Result::join('users', 'results.user_id', '=', 'users.id')
                        ->orderByDesc('results.measure_c_score')
                        ->skip($upperPercentileCount)
                        ->take($middlePercentileCount)
                        ->select('users.*', 'results.measure_c_score')
                        ->get();

                    // Retrieve lower threshold users based on the weighted average
                    $lowerThresholdUsers = Result::join('users', 'results.user_id', '=', 'users.id')
                        ->orderBy('results.measure_c_score')  // Order in ascending order for lower threshold
                        ->take($lowerPercentileCount)
                        ->select('users.*', 'results.measure_c_score')
                        ->get();

                    // Separate responses of the threshold users
                    $upperThresholdUserResponses = $responses->whereIn('user_id', $upperThresholdUsers->pluck('id'));
                    $middleThresholdUserResponses = $responses->whereIn('user_id', $middleThresholdUsers->pluck('id'));
                    $lowerThresholdUserResponses = $responses->whereIn('user_id', $lowerThresholdUsers->pluck('id'));

                    // Count correct responses for upper threshold users
                    $totalUpperCorrectResponses = $upperThresholdUserResponses->where('choice_id', $correctChoiceId)->count();

                    // Count correct responses for middle threshold users
                    $totalMiddleCorrectResponses = $middleThresholdUserResponses->where('choice_id', $correctChoiceId)->count();

                    // Count correct responses for lower threshold users
                    $totalLowerCorrectResponses = $lowerThresholdUserResponses->where('choice_id', $correctChoiceId)->count();

                
                    // Calculate Discrimination Index for the upper, middle, and lower threshold users
                    // $totalUpperThresholdUserResponses = $upperThresholdUserResponses->count();
                    // $totalMiddleThresholdUserResponses = $middleThresholdUserResponses->count();
                    // $totalLowerThresholdUserResponses = $lowerThresholdUserResponses->count();
                    // $totalOtherUsersResponses = $totalResponses - $totalUpperThresholdUserResponses - $totalMiddleThresholdUserResponses - $totalLowerThresholdUserResponses;

                    // Calculate the discrimination index
                    $di = round(($correctResponses) / $totalResponses);

                    $N = round(($totalUpperCorrectResponses - $totalLowerCorrectResponses) / $totalResponses, 2);
                    $DI[$index] = $di;
                    $DS[$index] = $N;
                }
            }
        
            
            
            
            
            }
        return view('admin.reports.item-analysis-revise', compact('questions', 'DI', 'DS', 'questionCount'));
    } 
    public function ShowItemAnalysisDiscard(){   
        $DI = [];
        $DS = [];
        $questionCount = Question::all();
        $questions = Question::where('category', 'Discard')->paginate(10);

        
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

                    // Calculate the percentage of correct responses
                    $percentageCorrect = ($totalResponses > 0) ? ($correctResponses / $totalResponses) * 100 : 0;

                    $totalStudents = User::where("Role", "Student")->count();

                    $percentileThreshold = 27; // Change this to the desired percentile

                    // Calculate the number of users required for each percentile
                    $upperPercentileCount = ceil(($percentileThreshold / 100) * $totalResponses);
                    $lowerPercentileCount = ceil(($percentileThreshold / 100) * $totalResponses); // Set the lower count to the same as the upper count
                    $middlePercentileCount = $totalResponses - 2 * $upperPercentileCount; // Remaining for the middle

                    // Retrieve upper threshold users based on the weighted average
                    $upperThresholdUsers = Result::join('users', 'results.user_id', '=', 'users.id')
                        ->orderByDesc('results.measure_c_score')
                        ->select('users.*', 'results.measure_c_score')
                        ->take($upperPercentileCount)
                        ->get();

                    // Retrieve middle threshold users based on the weighted average
                    $middleThresholdUsers = Result::join('users', 'results.user_id', '=', 'users.id')
                        ->orderByDesc('results.measure_c_score')
                        ->skip($upperPercentileCount)
                        ->take($middlePercentileCount)
                        ->select('users.*', 'results.measure_c_score')
                        ->get();

                    // Retrieve lower threshold users based on the weighted average
                    $lowerThresholdUsers = Result::join('users', 'results.user_id', '=', 'users.id')
                        ->orderBy('results.measure_c_score')  // Order in ascending order for lower threshold
                        ->take($lowerPercentileCount)
                        ->select('users.*', 'results.measure_c_score')
                        ->get();

                    // Separate responses of the threshold users
                    $upperThresholdUserResponses = $responses->whereIn('user_id', $upperThresholdUsers->pluck('id'));
                    $middleThresholdUserResponses = $responses->whereIn('user_id', $middleThresholdUsers->pluck('id'));
                    $lowerThresholdUserResponses = $responses->whereIn('user_id', $lowerThresholdUsers->pluck('id'));

                    // Count correct responses for upper threshold users
                    $totalUpperCorrectResponses = $upperThresholdUserResponses->where('choice_id', $correctChoiceId)->count();

                    // Count correct responses for middle threshold users
                    $totalMiddleCorrectResponses = $middleThresholdUserResponses->where('choice_id', $correctChoiceId)->count();

                    // Count correct responses for lower threshold users
                    $totalLowerCorrectResponses = $lowerThresholdUserResponses->where('choice_id', $correctChoiceId)->count();

                
                    // Calculate Discrimination Index for the upper, middle, and lower threshold users
                    // $totalUpperThresholdUserResponses = $upperThresholdUserResponses->count();
                    // $totalMiddleThresholdUserResponses = $middleThresholdUserResponses->count();
                    // $totalLowerThresholdUserResponses = $lowerThresholdUserResponses->count();
                    // $totalOtherUsersResponses = $totalResponses - $totalUpperThresholdUserResponses - $totalMiddleThresholdUserResponses - $totalLowerThresholdUserResponses;

                    // Calculate the discrimination index
                    $di = round(($correctResponses) / $totalResponses);

                    $N = round(($totalUpperCorrectResponses - $totalLowerCorrectResponses) / $totalResponses, 2);
                    $DI[$index] = $di;
                    $DS[$index] = $N;
                }
            }
        
            
            
            
            
            }
        return view('admin.reports.item-analysis-discard', compact('questions', 'DI', 'DS', "questionCount"));
    } 
    
 
   public function ExportApplicantRanking(){
        return Excel::download(new ApplicantRankingExport, 'Rankings-Report.xlsx');
   }

   public function ExportQualifyingExam() 
   {
       return Excel::download(new ResultExport, 'Qualifying-Exam-Report.xlsx');
   }

    public function ExportItemAnalysis() 
    {

        $DI = [];
        $DS = [];
        
        $questions = Question::all();
        foreach ($questions as $index => $question) {
            // Check if there are exam responses for the current question
            $hasResponses = $question->examResponse()->exists();

            if ($hasResponses) {
                $choices = $question->choices;

                $correctChoice = $choices->where('is_correct', true)->first();
                $correctChoiceId = $correctChoice->id;

                $responses = ExamResponse::where('question_id', $question->id)->get();

                $totalResponses = $responses->count();
                $correctResponses = $responses->where('choice_id', $correctChoiceId)->count();

                // Calculate the percentage of correct responses
                $percentageCorrect = ($totalResponses > 0) ? ($correctResponses / $totalResponses) * 100 : 0;

                $totalStudents = User::where("Role", "Student")->count();

                $percentileThreshold = 27; // Change this to the desired percentile

                // Calculate the number of users required for each percentile
                $upperPercentileCount = ceil(($percentileThreshold / 100) * $totalResponses);
                $lowerPercentileCount = ceil(($percentileThreshold / 100) * $totalResponses); // Set the lower count to the same as the upper count
                $middlePercentileCount = $totalResponses - 2 * $upperPercentileCount; // Remaining for the middle

                // Retrieve upper threshold users based on the weighted average
                $upperThresholdUsers = Result::join('users', 'results.user_id', '=', 'users.id')
                    ->orderByDesc('results.measure_c_score')
                    ->select('users.*', 'results.measure_c_score')
                    ->take($upperPercentileCount)
                    ->get();

                // Retrieve middle threshold users based on the weighted average
                $middleThresholdUsers = Result::join('users', 'results.user_id', '=', 'users.id')
                    ->orderByDesc('results.measure_c_score')
                    ->skip($upperPercentileCount)
                    ->take($middlePercentileCount)
                    ->select('users.*', 'results.measure_c_score')
                    ->get();

                // Retrieve lower threshold users based on the weighted average
                $lowerThresholdUsers = Result::join('users', 'results.user_id', '=', 'users.id')
                    ->orderBy('results.measure_c_score')  // Order in ascending order for lower threshold
                    ->take($lowerPercentileCount)
                    ->select('users.*', 'results.measure_c_score')
                    ->get();

                // Separate responses of the threshold users
                $upperThresholdUserResponses = $responses->whereIn('user_id', $upperThresholdUsers->pluck('id'));
                $middleThresholdUserResponses = $responses->whereIn('user_id', $middleThresholdUsers->pluck('id'));
                $lowerThresholdUserResponses = $responses->whereIn('user_id', $lowerThresholdUsers->pluck('id'));

                // Count correct responses for upper threshold users
                $totalUpperCorrectResponses = $upperThresholdUserResponses->where('choice_id', $correctChoiceId)->count();

                // Count correct responses for middle threshold users
                $totalMiddleCorrectResponses = $middleThresholdUserResponses->where('choice_id', $correctChoiceId)->count();

                // Count correct responses for lower threshold users
                $totalLowerCorrectResponses = $lowerThresholdUserResponses->where('choice_id', $correctChoiceId)->count();

            
                // Calculate Discrimination Index for the upper, middle, and lower threshold users
                // $totalUpperThresholdUserResponses = $upperThresholdUserResponses->count();
                // $totalMiddleThresholdUserResponses = $middleThresholdUserResponses->count();
                // $totalLowerThresholdUserResponses = $lowerThresholdUserResponses->count();
                // $totalOtherUsersResponses = $totalResponses - $totalUpperThresholdUserResponses - $totalMiddleThresholdUserResponses - $totalLowerThresholdUserResponses;

                // Calculate the discrimination index
                $di = round(($correctResponses) / $totalResponses);

                $N = round(($totalUpperCorrectResponses - $totalLowerCorrectResponses) / $totalResponses, 2);
                $DI[$index] = $di;
                $DS[$index] = $N;
            }
        }

        
        return Excel::download(new ItemAnalysisReport($questions, $DI, $DS), 'Item-Analysis-Report.xlsx');
    }
   public function ShowUnqualifiedApplicants()
   {
   
    $results = Result::with('user')
    ->whereHas('user', function ($query) {
        $query->where('status', 'Unqualified');
    })
    ->whereNotNull('weighted_average')
    ->orderByDesc('weighted_average');
    $results = $results->paginate(10);

    return view('admin.reports.list-unqualified-applicant', compact('results'));
   }

   public function ShowQualifiedApplicants()
   {
   
    $results = Result::with('user')//studentInfo
    ->whereHas('user', function ($query) {
        $query->where('status', 'Qualified');
    })
    ->whereNotNull('weighted_average')
    ->orderByDesc('weighted_average');
    $results = $results->paginate(10);

    return view('admin.reports.list-qualified-applicant', compact('results'));
   }

   public function RetainQuestion($id){

        $question = Question::find($id);
        $question->category = "Retain";
        $question->save();
        return redirect()->back()->with('success', 'Question retain successfully!');
   }

   public function DiscardQuestion($id){
        $question = Question::find($id);
        $question->category = "Discard";
        $question->save();

        ExamQuestion::where('question_id', $id)->delete();

        return redirect()->back()->with('success', 'Question discard successfully!');
    }

    public function ReviseQuestion($id){
       
        $question = Question::find($id);
        return view('admin.dashboard-revise-question', compact('question'));
    }
   

    public function GenerateItemAnalysis(){
        
        Question::where('category', '!=', 'discard')
        ->update(['category' => null]);

         return redirect()->back()->with('success', 'Question revise successfully!');
    }

    public function StoreReviseQuestion(Request $request){
       // Question::

     
        $temp_question = Question::find($request->question_id);
        $temp_question->choices()->delete();
        $temp_question->delete();
        


        $img = $request->img;
       

        $request->validate([
            'question_text' => 'required',
            'choice_text' => 'required|array',
            'choice_text.*' => 'required|string',
            'correct_choice' => 'required|numeric',           

        ]);
      
            
        $question = new Question();
        $question->question_text = $request->question_text;  
        $question->category = "Revise";
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


        return redirect()->route('admin.dashboard.item-analysis');
    }

    public function ShowItemAnalysisReport(){

        $DI = [];
        $DS = [];
        $questionCount = Question::all();
        $questions = Question::where('category')->paginate(10);

        
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

       


        
        return view('admin.reports.item-analysis-report', compact('questions', 'DI', 'DS'));
    }
   
    public function ShowInterviewResult(){
        $results = Result::with('user')->whereNotNull('measure_a_score')->orderByDesc('measure_a_score')
        ->paginate(10);



        
        return view('admin.reports.list-of-inteview-result', compact('results'));
    }

    public function ExportQualified(){
        return Excel::download(new QualifiedApplicantExport, 'QualifiedApplicant.xlsx');
    }

    public function ExportUnqualified(){
        return Excel::download(new UnqualifiedApplicantExport, 'UnqualifiedApplicant.xlsx');
    }

}





