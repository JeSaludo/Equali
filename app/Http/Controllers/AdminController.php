<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function ShowAdminOverview()
    {
        return view('admin.dashboard-overview');
    }

    

   
}
