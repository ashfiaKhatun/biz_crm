<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function show()
    {
        $values = Settings::all();
        return view('template.home.settings.settings', compact('values')); 
    }

    public function storeDollar(Request $request)
    {

        Settings::create(
            [
                'setting_name' => 'Default Dollar Rate',
                'value' => $request->dollar_rate,
            ]
        ); // Use model for creation

        return redirect()->route('settings')->with('success', 'Data saved successfully!');
    }

    public function storePaymentMethod(Request $request)
    {

        Settings::create(
            [
                'setting_name' => 'Refill Payment Method',
                'value' => $request->payment_method,
            ]
        ); // Use model for creation

        return redirect()->route('settings')->with('success', 'Data saved successfully!');
    }

    public function storeVendor(Request $request)
    {

        Settings::create(
            [
                'setting_name' => 'Vendor',
                'value' => $request->vendor,
            ]
        ); // Use model for creation

        return redirect()->route('settings')->with('success', 'Data saved successfully!');
    }
}
