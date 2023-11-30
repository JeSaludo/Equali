<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, "Login"])->name("auth.login");
Route::post('/login/authenticate', [AuthController::class, 'Authenticate'])->name("auth.authenticate");

$rndRoute = "31dsda943dasd4azx2Qesd2123";
Route::get('/register/admin/' . $rndRoute, [AuthController::class, 'ShowAdminRegistration'])->name("auth.show.admin.registration");
Route::post('/register/store/admin/' . $rndRoute, [AuthController::class, 'CreateAccountAdmin'])->name("auth.store.admin.registration");


Route::get('/logout', [AuthController::class, 'Logout'])->name('auth.logout');


//link  register/admin/31dsda943dasd4azx2Qesd2123

Route::middleware(['admin'])->group(function () {
    Route::get('dashboard/overview', [AdminController::class, 'ShowAdminOverview'])->name('admin.dashboard.overview');   
    //Question 
    Route::get('/dashboard/question/add-question', [QuestionController::class, 'ShowAddQuestion'])->name('admin.dashboard.add-question');
    Route::get('/dashboard/view-questions', [QuestionController::class, 'ShowQuestions'])->name('admin.dashboard.view-question');
    Route::post('/dashboard/add-question/store', [QuestionController::class, 'StoreQuestion'])->name('admin.dashboard.store-question');
    Route::get('/dashboard/questions/{id}/edit', [QuestionController::class, 'ShowEditQuestion'])->name('admin.dashboard.edit-question');
    Route::put('/dashboard/questions/{id}', [QuestionController::class, 'UpdateQuestion'])->name('admin.dashboard.update-question');
    Route::delete('/dashboard/questions/{id}/delete', [QuestionController::class, 'DeleteQuestion'])->name('admin.dashboard.delete-question');
    //Interview 
    Route::get('/dashboard/interview-pending',[InterviewController::class, 'ShowPendingInterview'])->name('admin.dashboard.pending-interview');
    Route::get('/dashboard/interview/screening-form/{id}',[InterviewController::class, 'ShowScreeningForm'])->name('admin.dashboard.interview-now');
    Route::post('/dashboard/interview/store', [InterviewController::class, 'StoreInterview'])->name('admin.dashboard.store-interview');
   
    Route::get('/dashboard/interview/review', [InterviewController::class, 'ShowReview'])->name('admin.dashboard.show-review');
   
   
    //Applicant
    Route::get('/dashboard/view-applicant', [ApplicantController::class, 'ShowApplicant'])->name('admin.dashboard.show-applicant');
    Route::get('/dashboard/applicant/{id}/edit', [ApplicantController::class, "EditApplicant"])->name('admin.dashboard.edit-applicant');
    Route::post('/dashboard/add-applicant/store', [ApplicantController::class, 'StoreApplicant'])->name('admin.dashboard.store-applicant');
    Route::put('/dashboard/applicant/{id}', [ApplicantController::class, 'UpdateApplicant'])->name('admin.dashboard.update-applicant');
    Route::delete('/dashboard/applicant/{id}/delete', [ApplicantController::class, 'DeleteApplicant'])->name('admin.dashboard.delete-applicant');
    Route::get('/dashboard/archive-applicant', [ApplicantController::class, 'ShowArchiveApplicant'])->name('admin.dashboard.show-archive-applicant');
    Route::post('/dashboard/qualified-applicant/{id}/archived', [ApplicantController::class, 'ArchiveApplicant'])->name('admin.dashboard.archive-applicant');


    //rename this   // can be considered a qualified 
    Route::get('/dashboard/approved-applicant', [ApplicantController::class, 'ShowApprovedApplicant'])->name('admin.dashboard.show-approved-applicant');
   
    //Qualified 
    Route::get('/dashboard/list-of-scheduled-applicant', [ApplicantController::class, 'ShowQualifiedApplicant'])->name('admin.dashboard.show-qualified-appplicant');
    Route::get('/dashboard/qualified-applicant/{id}/edit', [ApplicantController::class, 'EditQualifiedApplicant'])->name('admin.dashboard.edit-qualified-appplicant');
    Route::get('/dashboard/qualified-applicant/store', [ApplicantController::class, 'StoreQualifiedApplicant'])->name('admin.dashboard.store-qualifiedpted-appplicant');
    Route::get('/dashboard/qualified-applicant/{id}/delete', [ApplicantController::class, 'DeleteQualifiedApplicant'])->name('admin.dashboard.delete-qualified-appplicant');

    Route::put('/dashboard/qualified-applicant/{id}', [ApplicantController::class, 'UpdateQualifiedApplicant'])->name('admin.dashboard.update-qualified-applicant');
    
    Route::post('/dashboard/qualified-applicant/{id}/approved', [ApplicantController::class, 'ApproveApplicant'])->name('admin.dashboard.approve-applicant');
    
    Route::post('/dashboard/qualified-applicant/set-schedule', [ApplicantController::class, 'Schedule'])->name('admin.dashboard.schedule-applicant'); 
    
    Route::get('/dashboard/report/item-analysis', [ReportController::class, 'ShowItemAnalysis'])->name('admin.dashboard.item-analysis');
    


});


    Route::middleware('auth')->group(function(){
    Route::get('/exam', [ExamController::class,'ShowExam'])->name('student.show-exam');
    Route::post('/exam/result', [ExamController::class, 'SubmitExam'])->name('submit-exam');
    });


    Route::get('/dashboard/exam', [ExamController::class, 'ShowAdminExam'])->name('admin.dashboard.show-exam');
    Route::get('/dashboard/exam/{id}/edit', [ExamController::class, 'EditExam'])->name('admin.dashboard.edit-exam');
    Route::put('/dashboard/exam/{id}', [ExamController::class, 'UpdateExam'])->name('admin.dashboard.update-exam');

    Route::post('/dashboard/exam/{id}/add-random', [ExamController::class, 'StoreRandomExam'])->name('admin.dashboard.store-random');
    Route::post('/dashboard/exam/store', [ExamController::class, 'StoreExam'])->name('admin.dashboard.store-exam');
    Route::delete('/dashboard/exam/{id}', [ExamController::class, 'DeleteExam'])->name('admin.dashboard.delete-exam');

    Route::get('/exam/result', [ExamController::class, 'ShowExamResult'])->name('student.exam-result');
    Route::get('/exam/already-responded', [ExamController::class, 'ShowAlreadyResponded'])->name('student.already-responded');

    Route::get('/dashboard/report/qualified-exam-result', [ReportController::class, 'ShowQualifyingExamResult'])->name('admin.report.qualified-exam');

    Route::get('/dashboard/report/item-analysis-report', [ReportController::class, 'ShowItemAnalysisReport'])->name('admin.report.item-analysis-report');
