<?php

namespace App\Http\Controllers;

use App\Exports\QualifiedITExport;
use App\Exports\QualifiedISExport;
use App\Exports\UnqualifiedApplicantExport;
use App\Exports\QualifiedApplicantExport;
use App\Exports\ApplicantRankingExport;
use App\Exports\ItemAnalysisReport;
use App\Exports\ResultExport;
use App\Exports\InterviewExport;
use Illuminate\Http\Request;
use App\Models\ItemAnalysisReport as IAReport;

use App\Models\Option;
use App\Models\Result;
use App\Models\Question;
use App\Models\Choice;
use App\Models\AcademicYears;
use App\Models\ExamQuestion;
use App\Models\ExamResponse;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



class ReportController extends Controller
{
    public function ShowQualifyingRankingResult(Request $request){

       
        $academicYears = AcademicYears::all();
        $selectedAcademicYear = $request->input('academicYears');

       


        $users = DB::table('users')
        ->select('users.*', 'results.*')
        ->join('results', 'results.user_id', '=', 'users.id')
        ->where('users.role', 'Student')
        ->whereNotNull('results.weighted_average')
        ->orderByDesc('results.weighted_average')
        ->where('users.status', 'Qualified');

        if(isset($selectedAcademicYear)){
            $users->where('academic_year_id', $selectedAcademicYear);
        }
        
        $users = $users->paginate(10);
        $users->appends(['academicYears' => $request->academicYears]);
    
    
        
        return view('admin.reports.qualified-applicants-ranking', compact('users','academicYears','selectedAcademicYear','request'));
    }

    

    

    public function ShowQualifyingRankingResultIS(Request $request){

      
        $academicYears = AcademicYears::all();
        $selectedAcademicYear = $request->input('academicYears');

        $users = DB::table('users')
        ->select('users.*', 'results.*', 'student_infos.*')
        ->join('results', 'results.user_id', '=', 'users.id')
        ->join('student_infos', 'student_infos.user_id', '=', 'users.id')
        ->where('users.role', 'Student')
        ->where('users.status', 'Qualified')
        ->where('student_infos.course','IS')
        ->whereNotNull('results.weighted_average')
        ->orderByDesc('results.weighted_average');
       

        if(isset($selectedAcademicYear)){
            $users->where('academic_year_id', $selectedAcademicYear);
        }
        
        $users = $users->paginate(10);
        $users->appends(['academicYears' => $request->academicYears]);
    
        return view('admin.reports.qualified-applicants-ranking-is', compact('users','academicYears','selectedAcademicYear','request'));
    }

    public function ShowQualifyingRankingResultIT(Request $request){

     
        $academicYears = AcademicYears::all();
        $selectedAcademicYear = $request->input('academicYears');

        $users = DB::table('users')
        ->select('users.*', 'results.*', 'student_infos.*')
        ->join('results', 'results.user_id', '=', 'users.id')
        ->join('student_infos', 'student_infos.user_id', '=', 'users.id')
        ->where('users.role', 'Student')
        ->where('users.status', 'Qualified')
        ->where('student_infos.course','IT')
        ->whereNotNull('results.weighted_average')
        ->orderByDesc('results.weighted_average');
       

        if(isset($selectedAcademicYear)){
            $users->where('academic_year_id', $selectedAcademicYear);
        }
        
        $users = $users->paginate(10);
        $users->appends(['academicYears' => $request->academicYears]);
        
        
        return view('admin.reports.qualified-applicants-ranking-it', compact('users','academicYears','selectedAcademicYear','request'));
    }
    public function ShowQualifyingExam(Request $request){

        $academicYears = AcademicYears::all();
        $selectedAcademicYear = $request->input('academicYears');
        
        
        $users = DB::table('users')
        ->select('users.*', 'results.*')
        ->join('results', 'results.user_id', '=', 'users.id')        
        ->where('users.role', 'Student') 
        ->whereNotNull('results.weighted_average')
        ->orderByDesc('results.total_exam_score');

       
        if(isset($selectedAcademicYear)){
            $users->where('academic_year_id', $selectedAcademicYear);
        }
        
        

        $users = $users->paginate(10);
        $users->appends(['academicYears' => $request->academicYears]);
      
        $option = Option::first();
        return view('admin.reports.list-of-qualifying-exam', compact('users', 'option','academicYears','selectedAcademicYear','request'));
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
    
 
   public function ExportApplicantRanking(Request $request){

        $acad = AcademicYears::find($request->academicYears);

       
        if($acad && $acad->year_name != null)
        {
            $year = $acad->year_name;
            return Excel::download(new ApplicantRankingExport($request->academicYears), 'Qualifying-Rankings-Report-' . $year .'.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        }
        return Excel::download(new ApplicantRankingExport($request->academicYears), 'Qualifying-Rankings-Report.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
   }

    public function ExportQualifyingExam(Request $request) 
    { 
        $acad = AcademicYears::find($request->academicYears);

       
        if($acad && $acad->year_name != null)
        {
            $year = $acad->year_name;
            return Excel::download(new ResultExport($request->academicYears), 'Qualifying-Exam-Report-' . $year .'.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        }
        return Excel::download(new ResultExport($request->academicYears), 'Qualifying-Exam-Report-All.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function ExportItemAnalysis(Request $request) 
    {

        $selectedYear = $request->selectedYear;
       
        
        $items = IAReport::all();        
   
        
        if (isset($selectedYear)) {
            $items->where('year', $selectedYear);
        }
        
        return Excel::download(new ItemAnalysisReport($items, $selectedYear), 'Item-Analysis-Report.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }
   public function ShowUnqualifiedApplicants(Request $request)
   {
   
    $academicYears = AcademicYears::all();
    $selectedAcademicYear = $request->input('academicYears');

    $users = DB::table('users')
    ->select('users.*', 'results.*')
    ->join('results', 'results.user_id', '=', 'users.id')
    ->where('users.role', 'Student')
    ->whereNotNull('weighted_average')      
    ->where('users.status', 'Unqualified');

    if(isset($selectedAcademicYear)){
        $users->where('academic_year_id', $selectedAcademicYear);
    }
    
    

    $users = $users->paginate(10);
    $users->appends(['academicYears' => $request->academicYears]);

    return view('admin.reports.list-unqualified-applicant', compact('users','academicYears','selectedAcademicYear','request'));


    
   }

   public function ShowQualifiedApplicants(Request $request)
   {

        $academicYears = AcademicYears::all();
        $selectedAcademicYear = $request->input('academicYears');
    
        $users = DB::table('users')
        ->select('users.*', 'results.*')
        ->join('results', 'results.user_id', '=', 'users.id')
        ->where('users.role', 'Student')
        ->whereNotNull('weighted_average')      
        ->where('users.status', 'Qualified');
    
        if(isset($selectedAcademicYear)){
            $users->where('academic_year_id', $selectedAcademicYear);
        }
        
        
    
        $users = $users->paginate(10);
        $users->appends(['academicYears' => $request->academicYears]);

        return view('admin.reports.list-qualified-applicant', compact('users','academicYears','selectedAcademicYear','request'));
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
       
        
        $question = Question::with('examResponse')->find($id);
      
        return view('admin.dashboard-revise-question', compact('question'));
    }
   

    

    public function StoreReviseQuestion(Request $request){
       // Question::
       $request->validate([
        'question_text' => 'required|unique:questions,question_text',
        'choice_text' => 'required|array',
        'choice_text.*' => 'required|string',
        'correct_choice' => 'required|numeric',           

        ]);    
        
        
        $img = $request->img;
            
     

        $question = Question::findOrFail($request->question_id);
        $question->question_text = $request->question_text;
        $question->category = "Revised";
        $currentYear = date('Y'); 
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


        return redirect()->route('admin.dashboard.item-analysis');
    }

    public function ShowItemAnalysisReport(Request $request){
        $uniqueYears = Question::distinct()->pluck('year')->toArray();
        $selectedYear = $request->selected_year;
        
        $items = IAReport::all();
        
   
        
        if (isset($selectedYear)) {
            $items->where('year', $selectedYear);
        }
      
      

        
        return view('admin.reports.item-analysis-report', compact('items','uniqueYears','selectedYear'));
    }
   
    public function ShowInterviewResult(Request $request){

        $academicYears = AcademicYears::all();

        $selectedAcademicYear = $request->input('academicYears');
       

        $users = DB::table('users')
        ->select('users.*', 'results.*', 'student_infos.*')
        ->join('results', 'results.user_id', '=', 'users.id')
        ->join('student_infos', 'student_infos.user_id', '=', 'users.id') 
        ->whereNotNull('measure_a_score')
        ->where('users.role', 'Student')
        ->orderByDesc('measure_a_score');



        if(isset($selectedAcademicYear)){
            $users->where('academic_year_id', $selectedAcademicYear);
        }
        $users = $users->paginate(10);
        $users->appends(['academicYears' => $request->academicYears]);


        return view('admin.reports.list-of-inteview-result', compact('users','academicYears','selectedAcademicYear', 'request'));
    }

    public function ExportQualified(Request $request){

        $acad = AcademicYears::find($request->academicYears);

       
        if($acad && $acad->year_name != null)
        {
            $year = $acad->year_name;
            return Excel::download(new QualifiedApplicantExport($request->academicYears), 'QualifiedApplicant-' . $year .'.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        }
        return Excel::download(new QualifiedApplicantExport($request->academicYears), 'QualifiedApplicant.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function ExportUnqualified(Request $request){

        $acad = AcademicYears::find($request->academicYears);

       
        if($acad && $acad->year_name != null)
        {
            $year = $acad->year_name;
            return Excel::download(new UnqualifiedApplicantExport($request->academicYears), 'Unqualified-Applicant-' . $year .'.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        }
        return Excel::download(new UnqualifiedApplicantExport($request->academicYears), 'UnqualifiedApplicant-All.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function ExportInterview(Request $request){        

        $acad = AcademicYears::find($request->academicYears);

       
        if($acad && $acad->year_name != null)
        {
            $year = $acad->year_name;
            return Excel::download(new InterviewExport($request->academicYears), 'Interview-' . $year .'.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        }
        
        return Excel::download(new InterviewExport($request->academicYears), 'Interview-all.pdf', \Maatwebsite\Excel\Excel::DOMPDF);

        
       }

    public function ExportQualifiedIT(Request $request){
        $acad = AcademicYears::find($request->academicYears);

       
        if($acad && $acad->year_name != null)
        {
            $year = $acad->year_name;
            return Excel::download(new QualifiedITExport($request->academicYears), 'QualifidIT-' . $year .'.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        }
        
        return Excel::download(new QualifiedITExport($request->academicYears), 'QuaifiedIT-all.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }
    public function ExportQualifiedIS(Request $request){
        $acad = AcademicYears::find($request->academicYears);

       
        if($acad && $acad->year_name != null)
        {
            $year = $acad->year_name;
            return Excel::download(new QualifiedISExport($request->academicYears), 'QualifidIS-' . $year .'.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        }
        
        return Excel::download(new QualifiedISExport($request->academicYears), 'QuaifiedIS-all.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

}





