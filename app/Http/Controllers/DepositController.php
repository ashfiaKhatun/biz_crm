<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{



    public function index()
    {
        $deposits = Deposit::orderBy('created_at', 'desc')->get();

        $threeMonthsAgo = Carbon::now()->subMonths(3);

        $averageRates = Deposit::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(amount_bdt) / SUM(amount_usd) as average_rate')
        )
        ->where('status', 'received')
        ->where('created_at', '>=', $threeMonthsAgo)
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();


        return view('template.home.deposit.index', compact('deposits', 'averageRates'));
    }
    public function create()
    {
        return view('template.home.deposit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount_usd' => 'required|numeric',
            'rate_bdt' => 'required|numeric',

        ]);
        $bdt = $request->amount_usd * $request->rate_bdt;
        Deposit::create([
            'name' => $request->name,
            'amount_usd' => $request->amount_usd,
            'rate_bdt' => $request->rate_bdt,
            'amount_bdt' => $bdt,
            'status' => 'received',
        ]);

        return redirect()->route('deposits.index')->with('success', 'Deposit created successfully.');
    }

    public function show($id)
    {
        $deposit = Deposit::findOrFail($id);
        return view('template.home.deposit.show', compact('deposit'));
    }

    public function edit($id)
    {
        $deposit = Deposit::findOrFail($id);
        return view('template.home.deposit.edit', compact('deposit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount_usd' => 'required|numeric',
            'rate_bdt' => 'required|numeric',

            'status' => 'required|string|in:pending,approved,rejected',
        ]);
        $bdt = $request->amount_usd * $request->rate_bdt;
        $deposit = Deposit::findOrFail($id);
        $deposit->update([
            'name' => $request->name,
            'amount_usd' => $request->amount_usd,
            'rate_bdt' => $request->rate_bdt,
            'amount_bdt' => $bdt,
            'status' => 'pending',
        ]);

        return redirect()->route('deposits.index')->with('success', 'Deposit updated successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,received,canceled',
        ]);

        $deposit = Deposit::findOrFail($id);
        $deposit->update(['status' => $request->status]);

        return redirect()->route('deposits.index')->with('success', 'Status updated successfully.');
    }

    public function destroy($id)
    {
        $deposit = Deposit::findOrFail($id);
        $deposit->delete();

        return redirect()->route('deposits.index')->with('success', 'Deposit deleted successfully.');
    }

    public function averageUsdRate()
    {
        $averageRates = Deposit::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(amount_bdt) / SUM(amount_usd) as average_rate')
        )
        ->where('status', 'received')
        ->groupBy('year', 'month')
        ->get();

        return view('template.home.deposit.average_usd_rate', compact('averageRates'));
    }
}
