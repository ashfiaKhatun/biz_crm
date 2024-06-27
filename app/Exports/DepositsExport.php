<?php

namespace App\Exports;

use App\Models\Deposit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DepositsExport implements FromCollection, WithHeadings
{
    protected $year;
    protected $month;

    public function __construct($year, $month)
    {
        $this->year = $year;
        $this->month = $month;
    }

    public function collection()
    {
        return Deposit::select('name', 'amount_usd', 'rate_bdt', 'amount_bdt', 'created_at')
            ->whereYear('created_at', $this->year)
            ->whereMonth('created_at', $this->month)
            ->where('status', 'received')
            ->get();
    }

    public function headings(): array
    {
        return ['Name', 'Amount USD', 'Rate BDT', 'Amount BDT', 'Created At'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Styling the first row (headings)
            1 => ['font' => ['bold' => true]],
            // Styling all columns
            'A' => ['alignment' => ['horizontal' => 'center']],
            'B' => ['alignment' => ['horizontal' => 'right']],
            'C' => ['alignment' => ['horizontal' => 'right']],
            'D' => ['alignment' => ['horizontal' => 'right']],
            'E' => ['alignment' => ['horizontal' => 'center']],
            'F' => ['alignment' => ['horizontal' => 'center']],
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER_00, // Format Amount USD as number with 2 decimal places
            'C' => NumberFormat::FORMAT_NUMBER_00, // Format Rate BDT as number with 2 decimal places
            'D' => NumberFormat::FORMAT_NUMBER_00, // Format Amount BDT as number with 2 decimal places
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY, // Format Created At as date
        ];
    }
}