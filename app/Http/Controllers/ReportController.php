<?php

namespace App\Http\Controllers;

use App\Exports\ResultExport;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Result;
use App\Models\Question;
use App\Models\Choice;
use App\Models\ExamQuestion;
use App\Models\ExamResponse;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;



class ReportController extends Controller
{
    

    public function ShowQualifyingExamResult(){

        // $users = User::where('role', 'Student')
        // ->with('result')
        // ->get();//can use result with student so it easy to use order by
        

        $results = Result::with('user')
        ->whereNotNull('weighted_average')
        ->orderByDesc('weighted_average')
        ->get();
        
        return view('admin.reports.qualified-applicants-ranking', compact('results'));
    }

    public function ShowItemAnalysisChart(){
       
        // $examResponses = ExamResponse::all();
        // $groupedResponses = $examResponses->groupBy(['question_id', 'selected_answer']);
      
        //$questions = Question::all(); // Fetch all questions
        $questions = Question::orderBy('id', 'asc')->get();

        // Eager load choices and student responses for all questions to avoid N+1 queries
        $questions->load('choices', 'examResponse');

       
     


        


        return view('admin.reports.item-analysis', compact('questions'));
    }




   public function ShowItemAnalysis(){    

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
        return view('admin.reports.item-analysis-report', compact('questions', 'DI', 'DS'));
   } 

    public function ShowQualifyingExam(Request $request){


        $results = Result::with('user')->whereNotNull('weighted_average')->orderByDesc('measure_c_score');
        
        $searchTerm = $request->input('searchTerm');
        if (!empty($searchTerm)) {
            $results->join('users', 'results.user_id', '=', 'users.id')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('users.first_name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('users.last_name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('measure_c_score', 'like', '%' . $searchTerm . '%');
                   
                });
        }      

      

        $results = $results->get();

        

        return view('admin.reports.list-of-qualifying-exam', compact('results'));
   }

    
   public function GenerateReport(){
        $excelFileName = 'qualifying_exam_report_' . now()->format('YmdHis') . '.xlsx';
        //return Excel::download(new YourExportClass($results), $excelFileName);

   }

   public function ExportQualifyingExam() 
   {
       return Excel::download(new ResultExport, 'result.xlsx');
   }
}




