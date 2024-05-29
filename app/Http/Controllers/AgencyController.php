<?php

namespace App\Http\Controllers;

use App\Models\Agencies;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException; // Import the ValidationException class

class AgencyController extends Controller
{

    public function index()
    {
        // Fetch all products
        $agencies = Agencies::all();

        // You can also filter or sort data using Eloquent methods
        // $products = Product::where('name', 'like', '%search term%')->get();

        return view('template.home.agencies.all_agency', compact('agencies')); // Pass data to view
    }

    public function add_agency()
    {
        return view('template.home.agencies.add_agency');
    }

    public function store(Request $request)
    {
        Agencies::create(
            [
                'agency_name' => $request['agency_name'],
                'location' => $request['location'],
                'commission_type' => $request['commission_type'],
                'dollar_rate' => $request['dollar_rate'],
                'percentage_rate' => $request['percentage_rate'],
                'ad_account_type' => $request['ad_account_type'],
            ]
        );


        return redirect()->route('all-agency')->with('success', 'Ad Account Agency added successfully.'); // Redirect after creation
    }

    public function details($id)
    {

        $agency = Agencies::findOrFail($id);

        return view('template.home.agencies.agency_details', compact('agency')); // Pass agency data to view
    }

    public function update($id)
    {
        $agency = Agencies::findOrFail($id);

        return view('template.home.agencies.update_agency', compact('agency')); // Pass agency data to view
    }

    public function storeUpdate(Request $request, $id)
    {
        $agency = Agencies::find($id);

        $agency->agency_name = $request->agency_name;
        $agency->location = $request->location;
        $agency->commission_type = $request->commission_type;
        $agency->dollar_rate = $request->dollar_rate;
        $agency->percentage_rate = $request->percentage_rate;
        $agency->ad_account_type = $request->ad_account_type;


        $agency->save();

        // Redirect to success page or perform other actions
        return redirect()->route('all-agency')->with('success', 'Ad Account Agency updated successfully.');
    }


    public function destroy($id)
    {
        $agency = Agencies::findOrFail($id);
        $agency->delete();

        return redirect()->route('all-agency')->with('success', 'Ad Account Agency deleted successfully.');
    }
}
