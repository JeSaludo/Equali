<?php

namespace App\Exports;

use App\Models\Result;
use App\Models\Option;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
class ResultExport implements FromView, WithStyles
{ 
    
    public $selectedYear;
    public function __construct($selectedYear){

            $this->selectedYear = $selectedYear;
    }
   
    public function view(): View
    {
        $selectedAcademicYear = $this->selectedYear;
       
        $users = DB::table('users')
        ->select('users.*', 'results.*')
        ->join('results', 'results.user_id', '=', 'users.id')        
        ->where('users.role', 'Student') 
        ->whereNotNull('results.weighted_average')
        ->orderByDesc('results.total_exam_score');

       
        if(isset($selectedAcademicYear)){
            $users->where('academic_year_id', $selectedAcademicYear);
        }

        $users = $users->get();
        $option = Option::first();
        return view('exports.qualified-exam-report', ['users' => $users, 'option' => $option]);
            
     
       
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
            'B' => 20,  // Adjust the width for column B
            'C' => 20,  // Adjust the width for column C
            'D' => 18,  // Adjust the width for column D
            
        ];

        foreach ($columnWidths as $column => $width) {
            $sheet->getColumnDimension($column)->setWidth($width);
        }

        // Center-align all the cells in the worksheet
        $sheet->getStyle($sheet->calculateWorksheetDimension())->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }
}
