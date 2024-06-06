<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;

class DepositController extends Controller
{

    public function index()
    {
        $deposits = Deposit::all();
        return view('template.home.deposit.index', compact('deposits'));
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
        $bdt=$request->amount_usd*$request->rate_bdt;
        Deposit::create([
            'name' => $request->name,
            'amount_usd' => $request->amount_usd,
            'rate_bdt' => $request->rate_bdt,
            'amount_bdt' => $bdt,
            'status' => 'pending',
        ]);

        return redirect()->route('template.home.deposit.index')->with('success', 'Deposit created successfully.');
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
            'amount_bdt' => 'required|numeric',
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        $deposit = Deposit::findOrFail($id);
        $deposit->update($request->all());

        return redirect()->route('template.home.deposit.index')->with('success', 'Deposit updated successfully.');
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

        return redirect()->route('template.home.deposit.index')->with('success', 'Deposit deleted successfully.');
    }
}
