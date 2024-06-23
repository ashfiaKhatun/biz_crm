<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgencyTransaction;
use App\Models\Refill;

class AgencyTransactionController extends Controller
{
    public function sendToAgency($id)
    {
        $refill = Refill::findOrFail($id);


        $refill->update(['sent_to_agency' => 1,'assign' => auth()->user()->name]);
        return redirect()->route('refills.index')->with('success', 'Deposit sent to agency successfully.');
    }
}
