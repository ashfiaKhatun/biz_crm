<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agencies;
use App\Models\AdAccount;


class AdAccountController extends Controller
{
    public function create()
    {
        $agencies = Agencies::all(); // Fetch all ad account agencies
        $customers = User::where('role', 'customer')->get(); // Fetch all users with role 'customer'
        return view('template.home.ad_account.ad_account_application', compact('agencies', 'customers')); // Pass the data to the view
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|exists:users,id',
            'ad_acc_name' => 'required|string|max:255',
            'bm_id' => 'required|string|max:255',
            'fb_link1' => 'nullable|string|max:255',
            'fb_link2' => 'nullable|string|max:255',
            'fb_link3' => 'nullable|string|max:255',
            'fb_link4' => 'nullable|string|max:255',
            'fb_link5' => 'nullable|string|max:255',
            'domain1' => 'nullable|string|max:255',
            'domain2' => 'nullable|string|max:255',
            'domain3' => 'nullable|string|max:255',
            'agency' => 'required|exists:ad_account_agencies,id',
            'ad_acc_type' => 'required|string|max:255',
            'dollar_rate' => 'required|numeric',
        ]);

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

        return redirect()->route('ad-account.create')->with('success', 'Ad Account Application submitted successfully.');
    }
}
