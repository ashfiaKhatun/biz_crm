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

    public function indexClient($id)
    {
        $notifications = SystemNotification::where('notifiable_id', $id)->get();        
        return view('template.home.notification.indexClient', compact('notifications'));
    }
}
