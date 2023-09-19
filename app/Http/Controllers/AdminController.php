<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function ShowAdminOverview()
    {
        return view('admin.dashboard-overview');
    }

    function ShowAddQuestion()
    {
        return view('admin.dashboard-add-question');
    }

    function ShowQuestions(){
        return view('admin.dashboard-view-question');
    }
}
