<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobRole;

class JobsController extends Controller
{
    public function jobRoles()
    {
        $job_roles = JobRole::all();

        return response()->json([
            'status' => 'success',
            'data' => $job_roles
        ]);
    }
    
}
