<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;

class DepositController extends Controller
{
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

        return redirect()->route('deposit.create')->with('success', 'Deposit created successfully.');
    }
}
