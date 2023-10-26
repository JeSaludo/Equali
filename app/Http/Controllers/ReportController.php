<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function ShowApplicantRanking(){
        return view ('admin.dashboard-applicant-ranking');
    }
}
