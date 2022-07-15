<?php

namespace App\Http\Controllers\Web\Client;

use App\Models\Role;
use App\Models\User;
use App\Models\Mobile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'user_name' => 'required|string|unique:users,user_name',
            'email' => 'required|email|unique:users,user_name',
            'password' => 'required|confirmed|min:8',
        ]);
        if ($validator->failed()) {
            Session::flash('error', 'Validations Error');
            return back()->withErrors($validator->errors());
        }
        $role = Role::select('id')->where('name', 'client')->first();
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id
        ]);
        Mobile::create([
            'name' => $request->mobile,
            'user_id' => $user->id
        ]);
        Session::flash('msg', 'User Created Successfuly');
        return back();
    }
}
