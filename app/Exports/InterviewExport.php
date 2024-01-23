<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Result;
use App\Models\AcademicYears;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class InterviewExport implements FromView, WithStyles
{
    public $selectedYear;
    public function __construct($selectedYear){

            $this->selectedYear = $selectedYear;
    }

    public function view(): View
    {
        

        $selectedAcademicYear = $this->selectedYear;
       
        $users = DB::table('users')
        ->select('users.*', 'results.*', 'student_infos.*')
        ->join('results', 'results.user_id', '=', 'users.id')
        ->join('student_infos', 'student_infos.user_id', '=', 'users.id') 
        ->whereNotNull('measure_a_score')
        ->where('users.role', 'Student')
        ->orderByDesc('measure_a_score');

        

        if(isset($selectedAcademicYear)){
            $users->where('academic_year_id', $selectedAcademicYear);
        }
        $users = $users->get();
       
       
        
        return view('exports.interview-report', ['users' => $users]);
    }

    
    public function styles(Worksheet $sheet)
    {
        // Apply styles to the header row (A1:F1)
        $headerRow = $sheet->getStyle('A1:D1');
        $headerRow->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'wrapText' => true,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Set margin (column width) for each data column
        $columnWidths = [
            'A' => 8,  // Adjust the width for column A
            'B' => 25,  // Adjust the width for column B
            'C' => 25,  // Adjust the width for column C
            'D' => 25,  // Adjust the width for column D
           
        ];

        foreach ($columnWidths as $column => $width) {
            $sheet->getColumnDimension($column)->setWidth($width);
        }

        // Center-align all the cells in the worksheet
        $sheet->getStyle($sheet->calculateWorksheetDimension())->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }
}




