<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function ad_account_application()
    {
        return view('template.home.ad_account_application');
    }
    
    public function refill_application()
    {
        return view('template.home.refill_application');
    }
    
    public function add_agency()
    {
        return view('template.home.add_agency');
    }
}
