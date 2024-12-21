<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{
    public function getCountries(Request $request)
    {
        $cacheKey = "countries";
        $data = Cache::get($cacheKey);

        if (!$data) {
            // Fetch countries (or any other data you want to cache)
            $countries = Country::all();
    
            // Store the data in the cache without expiration
            Cache::forever($cacheKey, $countries);
    
            // Return the newly fetched data
            $data = $countries;
        }

        return response()->json([
            'countries' => $data,
        ]);
    }

    public function getStates(Request $request)
    {
        $iso2 = $request->input('iso2');
        $cacheKey = "states-$iso2";
        $data = Cache::get($cacheKey);

        if (!$data) {
            $states = Country::getByIso2($iso2)->states()->orderBy('name')->get();

            Cache::forever($cacheKey, $states);

            $data = $states;
        }

        return response()->json([
            'states' => $data,
        ]);
    }
}
