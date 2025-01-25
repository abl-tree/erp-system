<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class AccountController extends Controller
{
    public function getRoles()
    {
        $roles = Role::where('hidden', false)->get();

        return response()->json([
            'status' => 'success',
            'data' => $roles
        ]);
    }
}
