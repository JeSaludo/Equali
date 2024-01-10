<?php

namespace App\Http\Controllers;

use App\Models\QualifiedStudent;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    function calendar(){
        $appointments = QualifiedStudent::all();

       
      
        
        return view('admin.dashboard-view-scheduled-date', compact( 'appointments'));
    }
}
