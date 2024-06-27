<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DepositsExport;

class ReportController extends Controller
{
    public function monthlyReportDeposit()
    {
        $monthsWithData = Deposit::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month')
        )
            ->where('status', 'received')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('template.home.deposit.monthly_report', compact('monthsWithData'));
    }

    public function monthlyReportDepositDetail($year, $month)
    {
        $averageRate = Deposit::select(
            DB::raw('SUM(amount_bdt) / SUM(amount_usd) as average_rate')
        )
            ->where('status', 'received')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->first();

        $deposits = Deposit::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->where('status', 'received')
            ->get();

        return view('template.home.deposit.monthly_report_detail', compact('year', 'month', 'averageRate', 'deposits'));
    }

   

    public function downloadExcel($year, $month)
    {
        return Excel::download(new DepositsExport($year, $month), "monthly_report_{$year}_{$month}.xlsx");
    }
}
