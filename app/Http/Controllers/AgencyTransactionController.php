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

        if ($refill->adAccount->agency->commission_type == 'Percentage') {
            $agencyRate = $refill->adAccount->agency->percentage_rate;
            $refill_act_usd = (($agencyRate / 100) * $refill->amount_dollar) + $refill->amount_dollar;
             
            AgencyTransaction::create([
                'refills_id' => $refill->id,
                'cl_rate' => $refill->adAccount->dollar_rate,
                'refill_usd' => $refill->amount_dollar,
                'refill_tk' => $refill->amount_taka,
                'refill_act_usd' => $refill_act_usd, // or some logic to calculate actual values
                'refill_act_tk' => null,  // or some logic to calculate actual values
                'agency_charge_type' => $refill->adAccount->agency->commission_type,
                'agency_charge' => (($agencyRate / 100) * $refill->amount_dollar),
                'agency_rate' => $refill->adAccount->agency->percentage_rate
            ]);

            $refill->update(['sent_to_agency' => 1]);
        }

        elseif($refill->adAccount->agency->commission_type =='Dollar Rate')
        {
            

            $refill_act_tk= $refill->adAccount->agency->dollar_rate * $refill->amount_dollar;


            AgencyTransaction::create([
                'refills_id' => $refill->id,
                'cl_rate' => $refill->adAccount->dollar_rate,
                'refill_usd' => $refill->amount_dollar,
                'refill_tk' => $refill->amount_taka,
                
                'refill_act_tk' => $refill_act_tk,  
                'agency_charge_type' => $refill->adAccount->agency->commission_type,
                'agency_rate' => $refill->adAccount->agency->dollar_rate
            ]);

            $refill->update(['sent_to_agency' => 1]);
        }

        elseif($refill->adAccount->agency->commission_type =='Own Account')
        {
            

            


            AgencyTransaction::create([
                'refills_id' => $refill->id,
                'cl_rate' => $refill->adAccount->dollar_rate,
                'refill_usd' => $refill->amount_dollar,
                'refill_tk' => $refill->amount_taka,
                
                 
                'agency_charge_type' => $refill->adAccount->agency->commission_type,
                
            ]);

            $refill->update(['sent_to_agency' => 1]);
        }



        return redirect()->route('refills.index')->with('success', 'Deposit sent to agency successfully.');
    }
}
