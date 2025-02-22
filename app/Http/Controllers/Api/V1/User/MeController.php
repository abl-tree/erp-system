<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $user->load('businesses');

        $resource = new UserResource($user);

        return response()->json([
            'status' => 'success',
            'data' => $resource
        ]);
    }
}
