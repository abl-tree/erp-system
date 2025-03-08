<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\SubRole;
use App\Models\UserStatus;

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
    
    public function getSubRoles($id)
    {
        $roles = SubRole::where('role_id', $id)->get();

        return response()->json([
            'status' => 'success',
            'data' => $roles
        ]);
    }

    public function getStatuses()
    {
        $statuses = UserStatus::all();

        return response()->json([
            'status' => 'success',
            'data' => $statuses
        ]);
    }
}
