<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException; // Import the ValidationException class

class HomeController extends Controller
{
    public function ad_account_application()
    {
        return view('template.home.ad_account.ad_account_application');
    }
    
    
    
    public function add_agency()
    {
        return view('template.home.agencies.add_agency');
    }
}
