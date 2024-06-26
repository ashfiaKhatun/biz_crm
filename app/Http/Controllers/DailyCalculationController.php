<?php

namespace App\Http\Controllers;

use App\Models\AdAccount;
use App\Models\DailyCalculation;
use Illuminate\Http\Request;

class DailyCalculationController extends Controller
{
    public function index()
    {
        $dailyReports = DailyCalculation::orderBy('created_at', 'desc')->get();
        return view('template.home.daily_report.index', compact('dailyReports'));
    }

    public function create()
    {
        $adAccounts = AdAccount::where('status', 'approved')->get();
        return view('template.home.daily_report.create', compact('adAccounts'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'running_balance' => 'required|array',
            'remaining_balance' => 'required|array',
            'running_balance.*' => 'required|numeric',
            'remaining_balance.*' => 'required|numeric',
        ]);

        // Calculate the sums
        $runningBalanceSum = array_sum($request->running_balance);
        $remainingBalanceSum = array_sum($request->remaining_balance);

        $totalBalance = $runningBalanceSum + $remainingBalanceSum;

        // Store the sums in the database
        DailyCalculation::create([
            'running_balance' => $runningBalanceSum,
            'remaining_balance' => $remainingBalanceSum,
            'total_balance' => $totalBalance,
        ]);

        // Redirect back or to another page with a success message
        return redirect()->route('dailyReport.index')->with('success', 'Balances saved successfully!');
    }
}
