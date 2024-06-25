<?php

namespace App\Http\Controllers;

use App\Models\AdAccount;
use App\Models\Refill;
use App\Models\SystemNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException; // Import the ValidationException class

class HomeController extends Controller
{

    public function dashboard()
    {
        $allApplication = AdAccount::all()->count();
        $pendingApplication = AdAccount::where('status', 'pending')->count();
        $allAdAccount = AdAccount::where('status', 'approved')->count();

        $currentMonth = Carbon::now()->month;
        $thisMonthRefill = Refill::whereMonth('created_at', $currentMonth)
            ->where('status', 'approved')
            ->sum('amount_dollar');


        $sevenDaysAgo = Carbon::now()->subDays(7);

        $lastSevenDaysRefill = Refill::where('status', 'approved')
            ->whereBetween('created_at', [$sevenDaysAgo, Carbon::now()])
            ->sum('amount_dollar');

        $pendingRefillCount = Refill::where('status', 'pending')->count();
        $pendingRefillAmount = Refill::where('status', 'pending')->sum('amount_dollar');

        $refills = Refill::with('adAccount')
            ->where('payment_method', '!=', 'Transferred')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $adAccounts = AdAccount::with('client')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();


        return view('template.home.index', compact('allApplication', 'pendingApplication', 'allAdAccount', 'thisMonthRefill', 'pendingRefillCount', 'pendingRefillAmount', 'lastSevenDaysRefill', 'refills', 'adAccounts'));
    }

    public function index()
    {
        $notifications = SystemNotification::orderBy('created_at', 'desc')->get();

        return view('template.home.notification.index', compact('notifications'));
    }

    public function indexClient($id)
    {
        $notifications = SystemNotification::where('notifiable_id', $id)->orderBy('created_at', 'desc')->get();
        return view('template.home.notification.index', compact('notifications'));
    }
}
