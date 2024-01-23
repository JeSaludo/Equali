<?php

namespace App\Exports;

use App\Models\Results;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ApplicantRankingExport implements FromView, WithStyles
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
        ->whereNotNull('weighted_average')
        ->orderByDesc('weighted_average')
        ->where('users.status', 'Qualified');

        if(isset($selectedAcademicYear)){
            $users->where('academic_year_id', $selectedAcademicYear);
        }

        $users = $users->get();
        return view('exports.ranking-report', ['users' => $users]);
    }

    public function styles(Worksheet $sheet)
    {
        // Apply styles to the header row (A1:F1)
        $headerRow = $sheet->getStyle('A1:F1');
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
            'E' => 22,  // Adjust the width for column E
            'F' => 15,  // Adjust the width for column F
            // Add more columns as needed
        ];

        foreach ($columnWidths as $column => $width) {
            $sheet->getColumnDimension($column)->setWidth($width);
        }

        // Center-align all the cells in the worksheet
        $sheet->getStyle($sheet->calculateWorksheetDimension())->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }
}
