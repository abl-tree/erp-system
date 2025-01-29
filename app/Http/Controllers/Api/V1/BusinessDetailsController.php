<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\BusinessFeatures;
use App\Models\BusinessType;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\User;

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

    public function createBusiness(Request $request)
    {
        $request->validate([
            'business_type' => 'required|numeric',
            'custom_url' => 'nullable|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'job_roles' => 'required_without:custom_job_roles|array',
            'job_roles.*' => 'integer',
            'custom_job_roles' => 'required_without:job_roles|array',
            'features' => 'required|array',
            'features.*' => 'integer'
        ]);

        $business = new Business([
            'business_type_id' => $request->business_type,
            'custom_url' => $request->custom_url,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city
        ]);

        $request->user()->businesses()->save($business);

        // $business->features()->sync($request->features);

        return response()->json([
            'status' => 'success',
            'data' => $business
        ]);
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
            'street' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'postal_code' => 'required|string',
            'business_type' => 'required|integer',
            'role' => 'required|integer|exists:roles,id',
            'job_position' => 'required_if:role,3',
            'department' => 'required_if:role,3',
            'employment_type' => 'required_if:role,3',
            'start_date' => 'required_if:role,3',
            'attendance_shift' => 'required_if:role,3',
        ], [
            'job_position.required_if' => 'The job position field is required.',
            'department.required_if' => 'The department field is required.',
            'employment_type.required_if' => 'The employment type field is required.',
            'start_date.required_if' => 'The start date field is required.',
            'attendance_shift.required_if' => 'The attendance shift field is required.',
        ]);

        $user = new User([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'business_name' => '',
            'password' => bcrypt('password')
        ]);

        if ($user->save()) {
            $user->roles()->attach($request->role);
            $role = $user->roles()->first();
            $user->update([
                'user_role_id' => $role->pivot->id ?? null
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => $user,
        ]);
    }

    public function getUsers(Request $request)
    {
        $users = User::with('roles')->paginate($request->per_page ?? 10);

        return response()->json([
            'status' => 'success',
            'data' => $users
        ]);
    }
}
