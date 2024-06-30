<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\SystemNotification;

class DepositController extends Controller
{



    public function index()
    {
        $deposits = Deposit::orderBy('created_at', 'desc')->get();

        $threeMonthsAgo = Carbon::now()->subMonths(3);

        $averageRates = Deposit::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(amount_bdt) / SUM(amount_usd) as average_rate'),
            DB::raw('SUM(amount_usd) as total_usd')
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
        $vendors = Settings::where('setting_name', 'Vendor')->get();
        return view('template.home.deposit.create', compact('vendors'));
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

        SystemNotification::create([
            'notification' => "Deposit of amount {$request->amount_usd} recived form{$request->name}, procesed by " . auth()->user()->name,
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
            'new_date' => 'nullable|date',

            'status' => 'required|string|in:pending,received,canceled',
        ]);
        $bdt = $request->amount_usd * $request->rate_bdt;
        $deposit = Deposit::findOrFail($id);
        if ($request->has('new_date')) {
            $newDate = Carbon::parse($request->new_date);
            // Preserve original time from existing 'created_at'
            $newDateTime = $newDate->format('Y-m-d') . ' ' . $deposit->created_at->format('H:i:s');
            $deposit->created_at = $newDateTime;
        }
        $deposit->update([
            'name' => $request->name,
            'amount_usd' => $request->amount_usd,
            'rate_bdt' => $request->rate_bdt,
            'amount_bdt' => $bdt,
            'status' => $request->status,
        ]);

        SystemNotification::create([
            'notification' => "Deposit information edited by " . auth()->user()->name,
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

        SystemNotification::create([
            'notification' => "Deposit status changed by " . auth()->user()->name,
        ]);

        return redirect()->route('deposits.index')->with('success', 'Status updated successfully.');
    }

    public function destroy($id)
    {
        $deposit = Deposit::findOrFail($id);
        $deposit->delete();
        SystemNotification::create([
            'notification' => "Deposit status removed by " . auth()->user()->name,
        ]);
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

