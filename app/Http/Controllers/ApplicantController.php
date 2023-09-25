<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    function ShowViewApplicant(){
        return view('admin.dashboard-view-applicant');
    }
}
