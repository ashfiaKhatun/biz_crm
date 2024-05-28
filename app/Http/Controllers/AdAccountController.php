<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agencies;


class AdAccountController extends Controller
{
    public function create()
    {
        $agencies = Agencies::all(); // Fetch all ad account agencies
        $customers = User::where('role', 'customer')->get(); // Fetch all users with role 'customer'
        return view('template.home.ad_account.ad_account_application', compact('agencies', 'customers')); // Pass the data to the view
    }
}
