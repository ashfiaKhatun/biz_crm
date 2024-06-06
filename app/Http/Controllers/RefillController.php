<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agencies;
use App\Models\AdAccount;
use App\Models\Refill;

class RefillController extends Controller
{

    public function index()
    {
        $refills = Refill::with('client', 'adAccount')->get();
        return view('template.home.refill_application.index', compact('refills'));
    }
    public function pending()
    {
        $refills = Refill::where('status', 'pending')->get();
        return view('template.home.refill_application.index', compact('refills'));
    }
    public function refill_application()
    {
        $customers = User::where('role', 'customer')->get();
        return view('template.home.refill_application.refill_application', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:users,id',
            'ad_account_id' => 'required|exists:ad_accounts,id',
            'amount_taka' => 'nullable|numeric',
            'amount_dollar' => 'nullable|numeric',
            'payment_method' => 'required|string|max:255',
            'transaction_id' => 'required|string|max:255',
            'screenshot' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('screenshot')) {
            $data['screenshot'] = $request->file('screenshot')->store('screenshots', 'public');
        }

        Refill::create($data);

        return redirect()->route('refills.index')->with('success', 'Refill application submitted successfully.');
    }


    public function show($id)
    {
        $refill = Refill::with('client', 'adAccount')->findOrFail($id);
        return view('template.home.refill_application.show', compact('refill'));
    }

    public function edit($id)
    {
        $refill = Refill::findOrFail($id);
        $customers = User::where('role', 'customer')->get();
        $adAccounts = AdAccount::where('client_id', $refill->client_id)->get();
        return view('template.home.refill_application..edit', compact('refill', 'customers', 'adAccounts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required|exists:users,id',
            'ad_account_id' => 'required|exists:ad_accounts,id',
            'amount_taka' => 'nullable|numeric',
            'amount_dollar' => 'nullable|numeric',
            'payment_method' => 'required|string|max:255',
            'transaction_id' => 'required|string|max:255',
            'screenshot' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|string|max:255',
        ]);

        $refill = Refill::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('screenshot')) {
            $data['screenshot'] = $request->file('screenshot')->store('screenshots', 'public');
        }

        $refill->update($data);

        return redirect()->route('refills.index')->with('success', 'Refill application updated successfully.');
    }

    public function destroy($id)
    {
        $refill = Refill::findOrFail($id);
        $refill->delete();

        return redirect()->route('refills.index')->with('success', 'Refill application deleted successfully.');
    }

    public function getClientAdAccounts($client_id)
    {
        $adAccounts = AdAccount::where('client_id', $client_id)
            ->where('status', 'approved')
            ->get();
        return response()->json($adAccounts);
    }

    public function getAdAccountDetails($id)
    {
        $adAccount = AdAccount::findOrFail($id);
        return response()->json($adAccount);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        $refill = Refill::findOrFail($id);
        $refill->update(['status' => $request->status]);

        return redirect()->route('refills.index')->with('success', 'Status updated successfully.');
    }
}
