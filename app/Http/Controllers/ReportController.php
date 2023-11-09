<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ReportController extends Controller
{
    

    public function ShowQualifyingExamResult(){

        $users = User::where('role', 'Student')
        ->with('result')
        ->get();
        
        
        return view('admin.reports.qualifed-applicant-result', compact('users'));
    }


    
}



