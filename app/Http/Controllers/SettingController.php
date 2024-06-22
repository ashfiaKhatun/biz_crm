<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function show()
    {
        $values = Settings::all();
        $defaultRate = Settings::where('setting_name', 'Default Dollar Rate')->first();
        if ($defaultRate) {
            return view('template.home.settings.settings', compact('values', 'defaultRate'));
        } else {
            return view('template.home.settings.settings', compact('values'));
        }
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

    public function updateDollar(Request $request, $id)
    {

        $dollarRate = Settings::findOrFail($id);
        $dollarRate->value = $request->dollar_rate;
        $dollarRate->save();

        return redirect()->route('settings')->with('success', 'Data updated successfully!');
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

    public function destroyPaymentMethod($id)
    {
        $paymentMethod = Settings::findOrFail($id);
        $paymentMethod->delete();

        return redirect()->route('settings')->with('success', 'Data deleted successfully!');
    }

    public function storeVendor(Request $request)
    {
        // Validate input
        $request->validate([
            'vendor' => 'required|string|max:255',
        ]);

        // Create a new vendor setting
        Settings::create([
            'setting_name' => 'Vendor',
            'value' => $request->vendor,
        ]);

        // Redirect back to the settings page with success message
        return redirect()->route('settings')->with('success', 'Vendor saved successfully!');
    }


    public function destroyVendor($id)
    {
        $vendor = Settings::findOrFail($id);
        $vendor->delete();

        return redirect()->route('settings')->with('success', 'Data deleted successfully!');
    }
}
