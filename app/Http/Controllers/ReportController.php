<?php

namespace App\Http\Controllers;

use App\Models\Agencies;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DepositsExport;
use App\Models\AgencyTransaction;
use App\Models\Refill;


class ReportController extends Controller
{


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
        $monthsWithData = Deposit::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month')
        )
            ->where('status', 'received')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('template.home.deposit.date-range-report', compact('monthsWithData'));
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

        $monthsWithData = Deposit::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month')
        )
            ->where('status', 'received')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('template.home.deposit.date-range-report', [
            'report' => $report,
            'deposits' => $deposits,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'monthsWithData' => $monthsWithData,
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

        foreach ($refills as $refill) {
            if (isset($refill->refill_act_taka)) {
                $refill->income_tk = $refill->refill_taka - $refill->refill_act_taka;
            } elseif (isset($refill->refill_act_usd)) {
                $refill->income_tk = $refill->refill_taka - $refill->refill_act_usd * $report->average_rate;
            } else {
                $refill->income_tk = $refill->refill_taka - $refill->refill_usd * $report->average_rate;
            }
        }

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

    public function downloadAdAccountMonthlyReportPdf($year, $month)
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

        // Generate the PDF
        $pdf = PDF::loadView('template.home.ad_account_report.pdf', compact('year', 'month', 'refills', 'averageRate'));
        return $pdf->download('ad_accounts_monthly_report_' . $year . '_' . $month . '.pdf');
    }





    public function showAvailableMonths()
    {
        $monthsWithData = DB::table('refills')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('template.home.agencies.available_months', compact('monthsWithData'));
    }

    public function monthlyReport($year, $month)
    {
        // Step 1: Calculate the average rate
        $averageRateQuery = Deposit::select(
            DB::raw('SUM(amount_bdt) / SUM(amount_usd) as average_rate')
        )
            ->where('status', 'received')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->first();

        $averageRate = $averageRateQuery ? $averageRateQuery->average_rate : 0;

        // Step 2: Fetch refills data with necessary calculations
        $refills = Refill::with('adAccount.agency')
            ->whereYear('refills.created_at', $year)
            ->whereMonth('refills.created_at', $month)
            ->select('refills.ad_account_id', 'refills.amount_taka', 'refills.amount_dollar')
            ->selectRaw('SUM(agency_transactions.refill_tk) as refill_taka')
            ->selectRaw('SUM(agency_transactions.refill_usd) as refill_usd')
            ->selectRaw('SUM(agency_transactions.refill_act_tk) as refill_act_taka')
            ->selectRaw('SUM(agency_transactions.refill_act_usd) as refill_act_usd')
            ->leftJoin('agency_transactions', 'refills.id', '=', 'agency_transactions.refills_id')
            ->where('refills.payment_method', '!=', 'Transferred')
            ->where('refills.status', 'approved')
            ->groupBy('refills.ad_account_id', 'refills.amount_taka', 'refills.amount_dollar')
            ->orderBy('refills.created_at', 'desc')
            ->get();

        // Calculate income for each refill and group by agencies
        $agencies = [];
        $refills->each(function ($refill) use ($averageRate, &$agencies) {
            if (isset($refill->refill_act_taka)) {
                $refill->income_tk = $refill->refill_taka - $refill->refill_act_taka;
            } elseif (isset($refill->refill_act_usd)) {
                $refill->income_tk = $refill->refill_taka - $refill->refill_act_usd * $averageRate;
            } else {
                $refill->income_tk = $refill->refill_taka - $refill->refill_usd * $averageRate;
            }

            $agency = $refill->adAccount->agency;
            if (!isset($agencies[$agency->id])) {
                $agencies[$agency->id] = (object) [
                    'agency_name' => $agency->agency_name,
                    'total_refill_taka' => 0,
                    'total_refill_dollar' => 0,
                    'total_income_tk' => 0,
                ];
            }

            $agencies[$agency->id]->total_refill_taka += $refill->amount_taka;
            $agencies[$agency->id]->total_refill_dollar += $refill->amount_dollar;
            $agencies[$agency->id]->total_income_tk += $refill->income_tk;
        });

        foreach ($agencies as $agency) {
            $agency->margin = $agency->total_refill_taka ? ($agency->total_income_tk / $agency->total_refill_taka) * 100 : 0;
        }

        return view('template.home.agencies.monthly_report', ['agencies' => $agencies, 'year' => $year, 'month' => $month]);
    }

    public function downloadMonthlyReportPdf($year, $month)
    {
        // Use the same logic as above to fetch the data
        $averageRateQuery = Deposit::select(
            DB::raw('SUM(amount_bdt) / SUM(amount_usd) as average_rate')
        )
            ->where('status', 'received')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->first();

        $averageRate = $averageRateQuery ? $averageRateQuery->average_rate : 0;

        $refills = Refill::with('adAccount.agency')
            ->whereYear('refills.created_at', $year)
            ->whereMonth('refills.created_at', $month)
            ->select('refills.ad_account_id', 'refills.amount_taka', 'refills.amount_dollar')
            ->selectRaw('SUM(agency_transactions.refill_tk) as refill_taka')
            ->selectRaw('SUM(agency_transactions.refill_usd) as refill_usd')
            ->selectRaw('SUM(agency_transactions.refill_act_tk) as refill_act_taka')
            ->selectRaw('SUM(agency_transactions.refill_act_usd) as refill_act_usd')
            ->leftJoin('agency_transactions', 'refills.id', '=', 'agency_transactions.refills_id')
            ->where('refills.payment_method', '!=', 'Transferred')
            ->where('refills.status', 'approved')
            ->groupBy('refills.ad_account_id', 'refills.amount_taka', 'refills.amount_dollar')
            ->orderBy('refills.created_at', 'desc')
            ->get();

        $agencies = [];
        $refills->each(function ($refill) use ($averageRate, &$agencies) {
            if (isset($refill->refill_act_taka)) {
                $refill->income_tk = $refill->refill_taka - $refill->refill_act_taka;
            } elseif (isset($refill->refill_act_usd)) {
                $refill->income_tk = $refill->refill_taka - $refill->refill_act_usd * $averageRate;
            } else {
                $refill->income_tk = $refill->refill_taka - $refill->refill_usd * $averageRate;
            }

            $agency = $refill->adAccount->agency;
            if (!isset($agencies[$agency->id])) {
                $agencies[$agency->id] = (object) [
                    'agency_name' => $agency->agency_name,
                    'total_refill_taka' => 0,
                    'total_refill_dollar' => 0,
                    'total_income_tk' => 0,
                ];
            }

            $agencies[$agency->id]->total_refill_taka += $refill->amount_taka;
            $agencies[$agency->id]->total_refill_dollar += $refill->amount_dollar;
            $agencies[$agency->id]->total_income_tk += $refill->income_tk;
        });

        foreach ($agencies as $agency) {
            $agency->margin = $agency->total_refill_taka ? ($agency->total_income_tk / $agency->total_refill_taka) * 100 : 0;
        }

        // Generate the PDF
        $pdf = PDF::loadView('template.home.agencies.monthly_report_pdf', ['agencies' => $agencies, 'year' => $year, 'month' => $month]);
        return $pdf->download('agencies_monthly_report_' . $year . '_' . $month . '.pdf');
    }
}
