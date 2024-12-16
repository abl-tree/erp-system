<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\BusinessFeatures;
use App\Models\BusinessType;
use Illuminate\Http\Request;

class BusinessDetailsController extends Controller
{
    public function businessTypes()
    {
        $businessTypes = BusinessType::all();

        return response()->json([
            'status' => 'success',
            'data' => $businessTypes
        ]);
    }

    public function businessFeatures($id = null)
    {
        if ($id === null) {
            $businessFeatures = BusinessFeatures::all();
            
            return response()->json([
                'status' => 'success',
                'data' => $businessFeatures
            ]);
        }

        $businessTypes = BusinessType::with('businessFeatures')->find($id);

        return response()->json([
            'status' => 'success',
            'data' => $businessTypes->businessFeatures
        ]);
    }
}
