<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agencies;
use App\Models\AdAccount;
use App\Models\Refill;
use App\Models\AgencyTransaction;
use App\Models\Settings;
use App\Models\SystemNotification;
use Carbon\Carbon;

class RefillController extends Controller
{

    public function index(Request $request)
    {
        $customers = User::where('role', 'customer')->get();
        $paymentMethods = Settings::where('setting_name', 'Refill Payment Method')->get();

        $query = Refill::with('client', 'adAccount')
            ->where('payment_method', '!=', 'Transferred')
            ->orderBy('created_at', 'desc');

        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            // Ensure the query works even if start date and end date are the same
            $query->whereBetween('created_at', [$startDate, $endDate . ' 23:59:59']);
        }

        $refills = $query->paginate(5); // Adjust the number of items per page as needed

        if ($request->ajax()) {
            return view('template.home.refill_application.filtered_data', compact('refills'))->render();
        }

        return view('template.home.refill_application.index', compact('refills', 'customers', 'paymentMethods'));
    }



    public function pending()
    {
        $refills = Refill::where('status', 'pending')->orderBy('created_at', 'desc')->get();
        return view('template.home.refill_application.index', compact('refills'));
    }
    public function refill_application()
    {
        $customers = User::where('role', 'customer')->get();
        $paymentMethods = Settings::where('setting_name', 'Refill Payment Method')->get();
        return view('template.home.refill_application.refill_application', compact('customers', 'paymentMethods'));
    }


    // new refill for customer
    public function newRefill($id)
    {
        $customer = User::where('id', $id)->get();
        $adaccount = AdAccount::where('client_id', $id)->get();
        $paymentMethods = Settings::where('setting_name', 'Refill Payment Method')->get();

        return view('template.home.refill_application.refill_application_new', compact('customer', 'paymentMethods', 'adaccount'));
    }
    // *************

    public function refill_application_id(AdAccount $adAccount)
    {
        $paymentMethods = Settings::where('setting_name', 'Refill Payment Method')->get();

        return view('template.home.refill_application.refill_application_id', compact('adAccount', 'paymentMethods')); // Pass the ad account to the refill view
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:users,id',
            'ad_account_id' => 'required|exists:ad_accounts,id',
            'amount_taka' => 'nullable|numeric',
            'amount_dollar' => 'nullable|numeric',
            'payment_method' => 'required|string|max:255',

            'screenshot' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('screenshot')) {
            $data['screenshot'] = $request->file('screenshot')->store('screenshots', 'public');
        }

        Refill::create($data);

        SystemNotification::create([
            'notification' => "Refill request of amount " . $request->input('amount_dollar') . " for ad account submitted by " . auth()->user()->name

        ]);

        return redirect()->route('refills.index')->with('success', 'Refill application submitted successfully.');
    }


    public function show($id)
    {
        $refill = Refill::with('client', 'adAccount')->findOrFail($id);
        return view('template.home.refill_application.show', compact('refill'));
    }

    public function edit($id)
    {
        if (auth()->user()->role == 'customer') {
            return redirect('/');
        }
        $refill = Refill::findOrFail($id);
        $paymentMethods = Settings::where('setting_name', 'Refill Payment Method')->get();
        $customers = User::where('role', 'customer')->get();
        $adAccounts = AdAccount::where('client_id', $refill->client_id)->get();
        return view('template.home.refill_application..edit', compact('refill', 'customers', 'adAccounts', 'paymentMethods'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }
        $request->validate([
            'client_id' => 'required|exists:users,id',
            'ad_account_id' => 'required|exists:ad_accounts,id',
            'amount_taka' => 'nullable|numeric',
            'amount_dollar' => 'nullable|numeric',
            'payment_method' => 'required|string|max:255',
            'transaction_id' => 'required|string|max:255',
            'new_date' => 'nullable|date',
            'screenshot' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|string|max:255',
        ]);

        $refill = Refill::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('screenshot')) {
            $data['screenshot'] = $request->file('screenshot')->store('screenshots', 'public');
        }

        if ($request->has('new_date')) {
            $newDate = Carbon::parse($request->new_date);
            // Preserve original time from existing 'created_at'
            $newDateTime = $newDate->format('Y-m-d') . ' ' . $refill->created_at->format('H:i:s');
            $refill->created_at = $newDateTime;
        }

        $refill->update($data);

        return redirect()->route('refills.index')->with('success', 'Refill application updated successfully.');
    }

    public function approve(Request $request, $id)
    {

        $refill = Refill::findOrFail($id);
        $refill->update([
            'status' => 'approved',
        ]);

        SystemNotification::create([
            'notification' => "Refill request status changed by " . auth()->user()->name
        ]);

        return redirect()->route('dashboard');
    }
    public function reject(Request $request, $id)
    {

        $refill = Refill::findOrFail($id);
        $refill->update([
            'status' => 'rejected',
        ]);

        SystemNotification::create([
            'notification' => "Refill request status changed by " . auth()->user()->name
        ]);

        return redirect()->route('dashboard');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }
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
        // Redirect customer role to home page
        if (auth()->user()->role == 'customer') {
            return redirect('/');
        }

        // Validate the request
        $request->validate([
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        $refill = Refill::findOrFail($id);

        // Check if the status is changing from 'approved' to something else
        if ($refill->status == 'approved' && $request->status != 'approved') {
            AgencyTransaction::where('refills_id', $refill->id)->delete();
        }

        // Process only if status is approved
        if ($request->status == 'approved') {
            $agency = $refill->adAccount->agency;
            $agencyTransactionData = [
                'refills_id' => $refill->id,
                'cl_rate' => $refill->adAccount->dollar_rate,
                'refill_usd' => $refill->amount_dollar,
                'refill_tk' => $refill->amount_taka,
                'agency_charge_type' => $agency->commission_type,
            ];

            if ($agency->commission_type == 'Percentage') {
                $agencyRate = $agency->percentage_rate;
                $refill_act_usd = (($agencyRate / 100) * $refill->amount_dollar) + $refill->amount_dollar;
                $agencyTransactionData['refill_act_usd'] = $refill_act_usd;
                $agencyTransactionData['agency_charge'] = ($agencyRate / 100) * $refill->amount_dollar;
                $agencyTransactionData['agency_rate'] = $agencyRate;

            } elseif ($agency->commission_type == 'Dollar Rate') {
                $refill_act_tk = $agency->dollar_rate * $refill->amount_dollar;
                $agencyTransactionData['refill_act_tk'] = $refill_act_tk;
                $agencyTransactionData['agency_rate'] = $agency->dollar_rate;

            } elseif ($agency->commission_type == 'Own Account') {
                // No additional fields needed for 'Own Account'
            }

            AgencyTransaction::create($agencyTransactionData);
        }

        // Update refill status and assign user
        $refill->update([
            'status' => $request->status,
            'assign' => auth()->user()->name
        ]);

        // Create a system notification
        SystemNotification::create([
            'notification' => "Refill request status changed by " . auth()->user()->name
        ]);

        // Redirect back with success message
        return redirect()->route('refills.index')->with('success', 'Status updated successfully.');
    }

}
