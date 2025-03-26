<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'business_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'password_confirmation' => ['required', 'string', 'same:password'],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one number, and one special character.',
        ])->validate();

        $user = User::create([
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'business_name' => $input['business_name'],
            'phone_number' => $input['phone_number'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    
        $user->roles()->attach(3, ['sub_role_id' => 1]);

        $user->sendEmailVerificationNotification();

        return $user;
    }
}
