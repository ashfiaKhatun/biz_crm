<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DepositsExport;
use App\Models\AgencyTransaction;
use App\Models\Refill;

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


    public function showDateRangeReportDeposit()
    {
        return view('template.home.deposit.date-range-report');
    }

    public function generateReportDeposit(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $report = Deposit::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'received')
            ->selectRaw('SUM(amount_bdt) / SUM(amount_usd) as average_rate')
            ->first();

        $deposits = Deposit::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'received')
            ->get();

        return view('template.home.deposit.date-range-report', [
            'report' => $report,
            'deposits' => $deposits,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }

    public function monthlyReportAdAccount()
    {
        $monthsWithData = AgencyTransaction::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month')
        )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('template.home.ad_account_report.index', compact('monthsWithData'));
    }

    public function generateReportAdAccount(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $report = Deposit::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'received')
            ->selectRaw('SUM(amount_bdt) / SUM(amount_usd) as average_rate')
            ->first();

        $refills = Refill::whereBetween('refills.created_at', [$startDate, $endDate])
            ->select('refills.ad_account_id')
            ->selectRaw('SUM(refills.amount_taka) as total_refill_taka')
            ->selectRaw('SUM(refills.amount_dollar) as total_refill_dollar')
            ->selectRaw('SUM(agency_transactions.refill_tk) as refill_taka')
            ->selectRaw('SUM(agency_transactions.refill_usd) as refill_usd')
            ->selectRaw('SUM(agency_transactions.refill_act_tk) as refill_act_taka')
            ->selectRaw('SUM(agency_transactions.refill_act_usd) as refill_act_usd')
            ->leftJoin('agency_transactions', 'refills.id', '=', 'agency_transactions.refills_id')
            ->where('refills.payment_method', '!=', 'Transferred')
            ->where('refills.status', 'approved')
            ->groupBy('refills.ad_account_id')
            ->orderBy('refills.created_at', 'desc') // Specify the table name here
            ->get();

        $monthsWithData = AgencyTransaction::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month')
        )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();


        return view('template.home.ad_account_report.index', [
            'report' => $report,
            'refills' => $refills,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'monthsWithData' => $monthsWithData
        ]);
    }

    public function monthlyReportAdAccountDetail($year, $month)
    {
        $averageRateQuery = Deposit::select(
            DB::raw('SUM(amount_bdt) / SUM(amount_usd) as average_rate')
        )
            ->where('status', 'received')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->first();

        $averageRate = $averageRateQuery ? $averageRateQuery->average_rate : 0;

        $refills = Refill::whereYear('refills.created_at', $year)
            ->whereMonth('refills.created_at', $month)
            ->select('refills.ad_account_id')
            ->selectRaw('SUM(refills.amount_taka) as total_refill_taka')
            ->selectRaw('SUM(refills.amount_dollar) as total_refill_dollar')
            ->selectRaw('SUM(agency_transactions.refill_tk) as refill_taka')
            ->selectRaw('SUM(agency_transactions.refill_usd) as refill_usd')
            ->selectRaw('SUM(agency_transactions.refill_act_tk) as refill_act_taka')
            ->selectRaw('SUM(agency_transactions.refill_act_usd) as refill_act_usd')
            ->leftJoin('agency_transactions', 'refills.id', '=', 'agency_transactions.refills_id')
            ->where('refills.payment_method', '!=', 'Transferred')
            ->where('refills.status', 'approved')
            ->groupBy('refills.ad_account_id')
            ->orderBy('refills.created_at', 'desc') // Specify the table name here
            ->get();

        $refills->each(function ($refill) use ($averageRate) {
            if (isset($refill->refill_act_taka)) {
                $refill->income_tk = $refill->refill_taka - $refill->refill_act_taka;
            } elseif (isset($refill->refill_act_usd)) {
                $refill->income_tk = $refill->refill_taka - $refill->refill_act_usd * $averageRate;
            } else {
                $refill->income_tk = $refill->refill_taka - $refill->refill_usd * $averageRate;
            }
        });


        return view('template.home.ad_account_report.show', compact('year', 'month', 'refills', 'averageRate'));
    }
}
