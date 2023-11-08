<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function ShowAdminOverview()
    {

        $recentApplicants = User::where('role', 'Student')
        ->with('admissionExam')
        ->latest('created_at')
        ->limit(5)
        ->get();
    
        return view('admin.dashboard-overview', compact('recentApplicants'));
    }

    

   
}
