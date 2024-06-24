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

class RefillController extends Controller
{

    public function index()
    {
        $refills = Refill::with('client', 'adAccount')
            ->where('payment_method', '!=', 'Transferred')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('template.home.refill_application.index', compact('refills'));
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
    public function newRefill($id )
    {
        $customer = User::where('id', $id)->get();
        $adaccount = AdAccount::where('client_id', $id)->get();
        $paymentMethods = Settings::where('setting_name', 'Refill Payment Method')->get();
        return view('template.home.refill_application.refill_application_new', compact('customer', 'paymentMethods','adaccount'));
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
        $customers = User::where('role', 'customer')->get();
        $adAccounts = AdAccount::where('client_id', $refill->client_id)->get();
        return view('template.home.refill_application..edit', compact('refill', 'customers', 'adAccounts'));
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
        if (auth()->user()->role == 'customer') {
            return redirect('/');
        }
        $request->validate([
            'status' => 'required|string|in:pending,approved,rejected',
        ]);



        if ($request->status == 'approved') {
            $refill = Refill::findOrFail($id);

            if ($refill->adAccount->agency->commission_type == 'Percentage') {
                $agencyRate = $refill->adAccount->agency->percentage_rate;
                $refill_act_usd = (($agencyRate / 100) * $refill->amount_dollar) + $refill->amount_dollar;

                AgencyTransaction::create([
                    'refills_id' => $refill->id,
                    'cl_rate' => $refill->adAccount->dollar_rate,
                    'refill_usd' => $refill->amount_dollar,
                    'refill_tk' => $refill->amount_taka,
                    'refill_act_usd' => $refill_act_usd, // or some logic to calculate actual values
                    'refill_act_tk' => null,  // or some logic to calculate actual values
                    'agency_charge_type' => $refill->adAccount->agency->commission_type,
                    'agency_charge' => (($agencyRate / 100) * $refill->amount_dollar),
                    'agency_rate' => $refill->adAccount->agency->percentage_rate
                ]);
            } elseif ($refill->adAccount->agency->commission_type == 'Dollar Rate') {


                $refill_act_tk = $refill->adAccount->agency->dollar_rate * $refill->amount_dollar;


                AgencyTransaction::create([
                    'refills_id' => $refill->id,
                    'cl_rate' => $refill->adAccount->dollar_rate,
                    'refill_usd' => $refill->amount_dollar,
                    'refill_tk' => $refill->amount_taka,

                    'refill_act_tk' => $refill_act_tk,
                    'agency_charge_type' => $refill->adAccount->agency->commission_type,
                    'agency_rate' => $refill->adAccount->agency->dollar_rate
                ]);
            } elseif ($refill->adAccount->agency->commission_type == 'Own Account') {





                AgencyTransaction::create([
                    'refills_id' => $refill->id,
                    'cl_rate' => $refill->adAccount->dollar_rate,
                    'refill_usd' => $refill->amount_dollar,
                    'refill_tk' => $refill->amount_taka,


                    'agency_charge_type' => $refill->adAccount->agency->commission_type,

                ]);
            }

            $refill->update(['status' => $request->status,'assign' => auth()->user()->name]);
        } else
            $refill = Refill::findOrFail($id);
        $refill->update(['status' => $request->status,'assign' => auth()->user()->name]);


        return redirect()->route('refills.index')->with('success', 'Status updated successfully.');
    }

}
