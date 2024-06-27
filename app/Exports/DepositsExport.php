<?php

namespace App\Exports;

use App\Models\Deposit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

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
        return Deposit::select('name', 'amount_usd', 'rate_bdt', 'amount_bdt', 'status', 'created_at')
            ->whereYear('created_at', $this->year)
            ->whereMonth('created_at', $this->month)
            ->where('status', 'received')
            ->get();
    }

    public function headings(): array
    {
        return ['Name', 'Amount USD', 'Rate BDT', 'Amount BDT', 'Status', 'Created At'];
    }
}
