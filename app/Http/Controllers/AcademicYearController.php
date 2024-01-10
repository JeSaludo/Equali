<?php

namespace App\Http\Controllers;

use App\Models\AcademicYears;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    
    public function CreateAcademicYear(Request $request){
        
        $request->validate([
            'newAcademicYear' => 'required|string|unique:academic_years,year_name',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        
        $acadYear = new AcademicYears();
        $acadYear->year_name = $request->newAcademicYear;
        $acadYear->start_date = $request->start_date;
        $acadYear->end_date = $request->end_date;
        $acadYear->save();

        return redirect()->back()->with('success', 'Succeccfuly added academic year');
    }
}
