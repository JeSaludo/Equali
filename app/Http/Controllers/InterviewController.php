<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InterviewController extends Controller
{
    function ShowPendingInterview(){
        return view('admin.dashboard-pending-interview');
    } 
    function ShowViewApplicant(){
        return view('admin.dashboard-view-applicant');
    }

    
}
