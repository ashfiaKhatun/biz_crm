<?php

namespace App\Http\Controllers;

use App\Models\Refill;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agencies;
use App\Models\AdAccount;
use Illuminate\Support\Facades\Auth;


class AdAccountController extends Controller
{
    public function index()
    {
        $adAccounts = AdAccount::orderBy('created_at', 'desc')->get();
        return view('template.home.ad_account.index', compact('adAccounts'));
    }

    public function account()
    {
        $userId = Auth::id(); // Get the ID of the current authenticated user
        $adAccounts = AdAccount::where('status', 'approved')
            ->where('client_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('template.home.ad_account.myaccount', compact('adAccounts'));
    }


    public function create()
    {
        $agencies = Agencies::all(); // Fetch all ad account agencies
        $customers = User::where('role', 'customer')->get(); // Fetch all users with role 'customer'
        return view('template.home.ad_account.ad_account_application', compact('agencies', 'customers')); // Pass the data to the view
    }

    public function ad_account_id(User $user)
    {
        $agencies = Agencies::all(); // Fetch all ad account agencies
        $customers = User::where('role', 'customer')->get(); // Fetch all users with role 'customer'
        return view('template.home.ad_account.ad_account_application_id', compact('user', 'agencies', 'customers')); // Pass the data to the view
    }



    public function store(Request $request)
    {
        if ($request->ad_acc_type) {
            AdAccount::create([
                'client_id' => $request->client_name,
                'ad_acc_name' => $request->ad_acc_name,
                'bm_id' => $request->bm_id,
                'fb_link1' => $request->fb_link1,
                'fb_link2' => $request->fb_link2,
                'fb_link3' => $request->fb_link3,
                'fb_link4' => $request->fb_link4,
                'fb_link5' => $request->fb_link5,
                'domain1' => $request->domain1,
                'domain2' => $request->domain2,
                'domain3' => $request->domain3,
                'agency_id' => $request->agency,
                'ad_acc_type' => $request->ad_acc_type,
                'dollar_rate' => $request->dollar_rate,
                'status' => 'pending', // Default status
            ]);
        } else {
            AdAccount::create([
                'client_id' => $request->client_name,
                'ad_acc_name' => $request->ad_acc_name,
                'bm_id' => $request->bm_id,
                'fb_link1' => $request->fb_link1,
                'fb_link2' => $request->fb_link2,
                'fb_link3' => $request->fb_link3,
                'fb_link4' => $request->fb_link4,
                'fb_link5' => $request->fb_link5,
                'domain1' => $request->domain1,
                'domain2' => $request->domain2,
                'domain3' => $request->domain3,
                'agency_id' => $request->agency,
                'ad_acc_type' => $request->ad_acc_type_select,
                'dollar_rate' => $request->dollar_rate,
                'status' => 'pending', // Default status
            ]);
        }


        return redirect()->route('ad-account.index')->with('success', 'Ad Account Application submitted successfully');
    }

    public function show($id)
    {
        $adAccount = AdAccount::findOrFail($id);
        $totalAmountUsd = Refill::where('ad_account_id', $id)
            ->where('status', 'approved')
            ->sum('amount_dollar');
        return view('template.home.ad_account.show', compact('adAccount', 'totalAmountUsd'));
    }

    public function myaccountshow($id)
    {
        $adAccount = AdAccount::findOrFail($id);
        $refills = Refill::where('ad_account_id', $id)->get();
        $totalAmountUsd = Refill::where('ad_account_id', $id)
            ->where('status', 'approved')
            ->sum('amount_dollar');

        $otherAdAccounts = AdAccount::where('id', '!=', $id)
            ->where('client_id', $adAccount->client_id)
            ->where('status', 'approved')
            ->get();
        return view('template.home.ad_account.myaccountshow', compact('adAccount', 'refills', 'totalAmountUsd','otherAdAccounts'));
    }

    public function edit($id)
    {
        $adAccount = AdAccount::findOrFail($id);
        $agencies = Agencies::all();
        $customers = User::where('role', 'customer')->get();
        return view('template.home.ad_account.edit', compact('adAccount', 'agencies', 'customers'));
    }

    public function update(Request $request, $id)
    {

        $adAccount = AdAccount::findOrFail($id);
        $adAccount->update([
            'client_id' => $request->client_name,
            'ad_acc_name' => $request->ad_acc_name,
            'bm_id' => $request->bm_id,
            'fb_links1' => $request->fb_links1,
            'fb_links2' => $request->fb_links2,
            'fb_links3' => $request->fb_links3,
            'fb_links4' => $request->fb_links4,
            'fb_links5' => $request->fb_links5,
            'domains1' => $request->domains1,
            'domains2' => $request->domains2,
            'domains3' => $request->domains3,
            'agency_id' => $request->agency,
            'ad_acc_type' => $request->ad_acc_type,
            'dollar_rate' => $request->dollar_rate,
            'status' => $request->status ?? 'pending',
        ]);

        return redirect()->route('ad-account.index')->with('success', 'Ad Account Application updated successfully.');
    }

    public function destroy($id)
    {
        $adAccount = AdAccount::findOrFail($id);
        $adAccount->delete();

        return redirect()->route('ad-account.index')->with('success', 'Ad Account Application deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,in-review,approved,canceled,rejected',
        ]);

        $adAccount = AdAccount::findOrFail($id);
        $adAccount->update(['status' => $request->status]);

        return redirect()->route('ad-account.index')->with('success', 'Status updated successfully.');
    }

    public function showPendingAdAccounts()
    {
        $adAccounts = AdAccount::where('status', 'pending')->orderBy('created_at', 'desc')->get();
        return view('template.home.ad_account.index', compact('adAccounts'));
    }
    public function showApprovedAdAccounts()
    {
        $adAccounts = AdAccount::where('status', 'approved')->orderBy('created_at', 'desc')->get();
        return view('template.home.ad_account.index', compact('adAccounts'));
    }


    public function transferForm($id)
    {

        $adAccount = AdAccount::findOrFail($id);
        $otherAdAccounts = AdAccount::where('id', '!=', $id)
            ->where('client_id', $adAccount->client_id)
            ->where('status', 'approved')
            ->get();

        return view('template.home.ad_account.transfer', compact('adAccount', 'otherAdAccounts'));
    }


    public function transfer(Request $request, $id)
    {
        $request->validate([
            'transfer_amount' => 'required|numeric|min:0.01',
            'recipient_account' => 'required|exists:ad_accounts,id',
        ]);

        $adAccount = AdAccount::findOrFail($id);
        $recipientAccount = AdAccount::findOrFail($request->recipient_account);

        Refill::create(
            [
                'client_id' => $adAccount->client_id,
                'ad_account_id' => $adAccount->id,
                'amount_dollar' => -($request['transfer_amount']),
                'amount_taka' => -($adAccount->dollar_rate * $request['transfer_amount']),
                'payment_method' => 'Transferred',
                'status' => 'approved',
            ]
        );

        Refill::create(
            [
                'client_id' => $recipientAccount->client_id,
                'ad_account_id' => $recipientAccount->id,
                'amount_dollar' => $request['transfer_amount'],
                'amount_taka' => ($adAccount->dollar_rate * $request['transfer_amount']),
                'payment_method' => 'Transferred',
                'status' => 'approved',
            ]
        );






        return redirect()->route('ad-account.show', $adAccount->id)->with('success', 'Amount transferred successfully.');
    }
}
