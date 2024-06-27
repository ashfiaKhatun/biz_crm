<?php

namespace App\Http\Controllers;

use App\Models\AdAccount;
use App\Models\Deposit;
use App\Models\Refill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonthlyReportController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $refills = Refill::whereMonth('refills.created_at', $currentMonth)
            ->select('refills.ad_account_id')
            ->selectRaw('SUM(refills.amount_taka) as total_refill_taka')
            ->selectRaw('SUM(refills.amount_dollar) as total_refill_dollar')
            ->selectRaw('SUM(agency_transactions.refill_tk) as refill_taka')
            ->selectRaw('SUM(agency_transactions.refill_act_tk) as refill_act_taka')
            ->selectRaw('SUM(agency_transactions.refill_act_usd) as refill_act_usd')
            ->leftJoin('agency_transactions', 'refills.id', '=', 'agency_transactions.refills_id')
            ->where('refills.payment_method', '!=', 'Transferred')
            ->where('refills.status', 'approved')
            ->groupBy('refills.ad_account_id')
            ->orderBy('refills.created_at', 'desc') // Specify the table name here
            ->get();

        $averageRates = Deposit::select(
            DB::raw('SUM(amount_bdt) / SUM(amount_usd) as average_rate')
        );


        return view('template.home.monthly_report.index', compact('refills', 'averageRates'));
    }
}
