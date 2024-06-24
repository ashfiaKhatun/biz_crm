<?php

namespace App\Http\Controllers;

use App\Models\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException; // Import the ValidationException class

class HomeController extends Controller
{
    public function index()
    {
        $notifications = SystemNotification::all();
        return view('template.home.notification.index', compact('notifications'));
    }
}
