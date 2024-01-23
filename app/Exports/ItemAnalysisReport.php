<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Result;
use App\Models\Question;
use App\Models\Choice;
use App\Models\ExamQuestion;
use App\Models\ExamResponse;
use App\Models\User;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
class ItemAnalysisReport implements FromView, WithStyles
{
    protected $items;
    
    protected $selectedYear;
   
    public function __construct($items, $selectedYear)
    {
        $this->items = $items;
    
        $this->selectedYear = $selectedYear;
       
    }
   
    public function view(): View
    {
        return view('exports.item-analysis-report', ['items' => $this->items, 'selectedYear' => $this->selectedYear]);
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
