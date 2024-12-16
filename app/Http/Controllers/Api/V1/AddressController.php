<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{
    public function getStates(Request $request)
    {
        // Get the country name from the request body
        $country = $request->input('country');
        
        // Make a request to the external CountriesNow API
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',  // Make sure we send JSON data
                'Accept' => 'application/json',        // Optionally set the accept header
            ])->post('https://countriesnow.space/api/v0.1/countries/states', [
                'country' => $country
            ]);
            
            // Return the response from CountriesNow API to the frontend
            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
