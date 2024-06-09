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
       

        $agencyRate =$refill->adAccount->agency->percentage_rate;
        $refill_act_usd= (($agencyRate/100)*$refill->amount_dollar)+$refill->amount_dollar;

        AgencyTransaction::create([
            'refills_id' => $refill->id,
            'cl_rate' => $refill->adAccount->dollar_rate,
            'refill_usd' => $refill->amount_dollar,
            'refill_tk' => $refill->amount_taka,
            'refill_act_usd' => $refill_act_usd, // or some logic to calculate actual values
            'refill_act_tk' => null,  // or some logic to calculate actual values
            'agency_charge_type' => $refill->adAccount->agency->commission_type,
            'agency_charge' => (($agencyRate/100)*$refill->amount_dollar),
        ]);

        $refill->update(['sent_to_agency' => 1]);
        return redirect()->route('refills.index')->with('success', 'Deposit sent to agency successfully.');
    }
}
