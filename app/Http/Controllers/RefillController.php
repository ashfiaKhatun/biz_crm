<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RefillController extends Controller
{
    public function refill_application()
    {
        return view('template.home.refill_application.refill_application');
    }

    public function update()
    {
        
        return view('template.home.refill_application.update_refill'); // Pass agency data to view
    }
}
