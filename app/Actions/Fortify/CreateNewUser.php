<?php

namespace App\Actions\Fortify;

use App\Models\Role;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255', Rule::unique(User::class),],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'mobile' => ['string', 'required','min:11', 'max:15'],
        ])->validate();
        $role = Role::select('id')->where('name', 'client')->first();
        $user = User::create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'user_name' => $input['user_name'],
            'role_id' => $role->id,
            'email' => $input['email'],
            'mobile' => $input['mobile'],
            'password' => Hash::make($input['password']),
        ]);
        return $user;
    }
}
