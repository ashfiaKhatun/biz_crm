<?php

namespace App\Http\Controllers;

use App\Models\AdAccount;
use App\Models\Refill;
use Illuminate\Http\Request;

class MonthlyReportController extends Controller
{
    public function index()
    {
        // $adAccounts = AdAccount::withSum('refills as total_refill_taka', 'amount_taka')
        // ->withSum('refills as total_refill_dollar', 'amount_dollar')
        // ->orderBy('created_at', 'desc')
        // ->where('status', 'approved')
        // ->get();
        // return view('template.home.monthly_report.index', compact('adAccounts'));

        $refills = Refill::select('refills.ad_account_id')
            ->selectRaw('SUM(refills.amount_taka) as total_refill_taka')
            ->selectRaw('SUM(refills.amount_dollar) as total_refill_dollar')
            ->selectRaw('SUM(agency_transactions.refill_tk) as refill_taka')
            ->selectRaw('SUM(agency_transactions.refill_act_tk) as refill_act_taka')
            ->leftJoin('agency_transactions', 'refills.id', '=', 'agency_transactions.refills_id')
            ->where('refills.payment_method', '!=', 'Transferred')
            ->where('refills.status', 'approved')
            ->groupBy('refills.ad_account_id')
            ->orderBy('refills.created_at', 'desc') // Specify the table name here
            ->get();

        
        return view('template.home.monthly_report.index', compact('refills'));
    }
}
