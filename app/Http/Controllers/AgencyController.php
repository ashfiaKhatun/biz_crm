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

        if ($request['ad_account_type'] === 'both') {
            Agencies::create(
                [
                    'agency_name' => $request['agency_name'],
                    'location' => $request['location'],
                    'commission_type' => $request['commission_type'],
                    'dollar_rate' => $request['dollar_rate'],
                    'percentage_rate' => $request['percentage_rate'],
                    'ad_account_type' => 'Credit Line',
                ]
            );
            Agencies::create(
                [
                    'agency_name' => $request['agency_name'],
                    'location' => $request['location'],
                    'commission_type' => $request['commission_type'],
                    'dollar_rate' => $request['dollar_rate'],
                    'percentage_rate' => $request['percentage_rate'],
                    'ad_account_type' => 'Card Line',
                ]
            );
        } else {
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
        }

        return redirect()->route('all-agency')->with('success', 'Ad Account Agency added successfully.'); // Redirect after creation
    }

    public function details($id)
    {
        // Fetch additional details for the agency (optional)
        // $detailedAgency = $agency->load(/* relations */);

        $agency = Agencies::findOrFail($id);

        return view('template.home.agencies.agency_details', compact('agency')); // Pass agency data to view
    }
}
