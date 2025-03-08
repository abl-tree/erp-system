<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\BusinessFeatures;
use App\Models\BusinessType;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\EmployeeProfile;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

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

        try {
            DB::beginTransaction();

            $business = new Business([
                'business_type_id' => $request->business_type,
                'custom_url' => $request->custom_url,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city
            ]);
    
            $request->user()->businesses()->save($business);
    
            // $business->features()->sync($request->features);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }

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
        ]);

        if ($request->role == 3) {
            $request->validate([
                'sub_role' => 'required_if:role,3',
                'job_position' => 'required_if:role,3',
                'department' => 'required_if:role,3|exists:departments,id',
                'employment_type' => 'required_if:role,3|exists:employment_types,id',
                'start_date' => 'required_if:role,3',
                'attendance_shift' => 'required_if:role,3|exists:attendance_shifts,id',
                'special_notes' => 'nullable|string'
            ], [
                'sub_role.required_if' => 'The sub role field is required.',
                'job_position.required_if' => 'The job position field is required.',
                'department.required_if' => 'The department field is required.',
                'employment_type.required_if' => 'The employment type field is required.',
                'start_date.required_if' => 'The start date field is required.',
                'attendance_shift.required_if' => 'The attendance shift field is required.',
            ]);
        }

        try {
            DB::beginTransaction();

            $user = new User([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phone_number' => $request->phone,
                'business_name' => '',
                'password' => bcrypt('password')
            ]);
    
            if ($user->save()) {
                $user->markEmailAsVerified();
                $user->roles()->attach($request->role, [
                    'sub_role_id' => $request->sub_role ?? null
                ]);
                $role = $user->roles()->first();
                $user->update([
                    'user_role_id' => $role->pivot->id ?? null
                ]);
    
                $profile = new UserProfile([
                    'address' => $request->street,
                    'city' => $request->city,
                    'country' => $request->country,
                    'postal_code' => $request->postal_code,
                    'business_type_id' => $request->business_type,
                    'role_id' => $request->role
                ]);
    
                $user->profile()->save($profile);
    
                if ($request->role == 3) {
                    $employee_profile = new EmployeeProfile([
                        'department_id' => $request->department,
                        'employment_type_id' => $request->employment_type,
                        'attendance_shift_id' => $request->attendance_shift,
                        'hired_at' => $request->start_date,
                        'job_position' => $request->job_position,
                        'special_notes' => $request->special_notes ?? ''
                    ]);
    
                    $user->employeeProfile()->save($employee_profile);
                }
    
                Password::sendResetLink(
                    ['email' => $user->email]
                );
    
                $user = $user->fresh();
                $user->load('businesses');
                $user->load('roles');
                $user->load('status');
                $user->load('profile.businessType');
                $user->load('employeeProfile');
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'data' => new UserResource($user)
        ]);
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:users,id',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'phone' => 'required|string',
            'street' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'postal_code' => 'required|string',
            'business_type' => 'required|integer',
            'role' => 'required|integer|exists:roles,id',
        ]);

        if ($request->role == 3) {
            $request->validate([
                'job_position' => 'required_if:role,3',
                'department' => 'required_if:role,3|exists:departments,id',
                'employment_type' => 'required_if:role,3|exists:employment_types,id',
                'start_date' => 'required_if:role,3',
                'attendance_shift' => 'required_if:role,3|exists:attendance_shifts,id',
                'special_notes' => 'nullable|string'
            ], [
                'job_position.required_if' => 'The job position field is required.',
                'department.required_if' => 'The department field is required.',
                'employment_type.required_if' => 'The employment type field is required.',
                'start_date.required_if' => 'The start date field is required.',
                'attendance_shift.required_if' => 'The attendance shift field is required.',
            ]);
        }

        try {
            DB::beginTransaction();
    
            $user = User::find($request->id);
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->phone_number = $request->phone;
    
            if ($user->save()) {
                $user->roles()->sync($request->role);
                $role = $user->roles()->first();
                $user->update([
                    'user_role_id' => $role->pivot->id ?? null
                ]);
    
                $profile = new UserProfile([
                    'address' => $request->street,
                    'city' => $request->city,
                    'country' => $request->country,
                    'postal_code' => $request->postal_code,
                    'business_type_id' => $request->business_type,
                    'role_id' => $request->role
                ]);
    
                $user->profile()->save($profile);
    
                if ($request->role == 3) {
                    $employee_profile = new EmployeeProfile([
                        'department_id' => $request->department,
                        'employment_type_id' => $request->employment_type,
                        'attendance_shift_id' => $request->attendance_shift,
                        'hired_at' => $request->start_date,
                        'job_position' => $request->job_position,
                        'special_notes' => $request->special_notes ?? ''
                    ]);
    
                    $user->employeeProfile()->save($employee_profile);
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'data' => $user,
        ]);
    }

    public function disableUser(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:users,id'
        ]);

        $user = User::find($request->id);
        $user->status_id = 2;
        $user->save();
        $user->load('status');

        return response()->json([
            'status' => 'success',
            'data' => new UserResource($user)
        ]);
    }

    public function getUsers(Request $request)
    {
        $auth = $request->user();
        $business = $auth->businesses()->first();
        $users = User::with(['businesses', 'roles', 'status', 'profile.businessType', 'employeeProfile'])
            ->when($request->filter['name'], function ($query) use ($request) {
                $query->searchFullName($request->filter['name']);
            })
            ->when($request->filter['address'], function ($query) use ($request) {
                $query->searchEmail($request->filter['address']);
            })
            ->when($request->filter['status'], function ($query) use ($request) {
                $query->where('status_id', $request->filter['status']);
            })
            ->when($request->filter['role'], function ($query) use ($request) {
                $query->whereHas('roles', function ($query) use ($request) {
                    $query->where('role_id', $request->filter['role']);
                });
            })
            ->whereHas('profile', function ($query) use ($business) {
                $query->where('business_type_id', $business->id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($request->per_page ?? 10);

        return response()->json([
            'status' => 'success',
            'data' => UserResource::collection($users),
            'meta' => [
                'total' => $users->total(),
                'current_page' => $users->currentPage(),
                'per_page' => $users->perPage(),
                'last_page' => $users->lastPage(),
                'from' => $users->firstItem(),
                'to' => $users->lastItem(),
                'prev_page_url' => $users->previousPageUrl(),
                'next_page_url' => $users->nextPageUrl(),
            ],
            'test' => $business
        ]);
    }
}
