<?php

namespace App\Http\Controllers\Web\Client;

use Exception;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index()
    {
        $client = Role::where('name', 'client')->first();
        $data['clients'] = User::where('role_id', $client->id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('dashboard.Clients.index')->with($data);
    }
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
        if ($request->role_id) {
            $role = $request->role_id;
        } else {
            $role = Role::select('id')->where('name', 'client')->first()->id;
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'role_id' => $role
        ]);
        Session::flash('msg', 'User Created Successfuly');
        return back();
    }

    public function promote($id, Request $request)
    {
        $client = User::findOrFail($id);
        if (Auth::user()->id == $id) {
            Session::flash('error', "You can't promote yourself!");
            return back();
        }
        if ($client->role->name == 'client') {
            $client->role_id =  Role::select('id')->where('name', 'counter')->first()->id;
            $client->save();
            Session::flash('msg', "user: $client->first_name  is promoted");
        } else {
            Session::flash('error', "user: $client->first_name  can't be promote");
        }
        return back();
    }
    public function demote($id, Request $request)
    {
        if (Auth::user()->id == $id) {
            Session::flash('error', "You can't demote yourself!");
            return back();
        }
        $user = User::findOrFail($id);
        if ($user->role->name == 'counter') {
            $user->role_id =  Role::select('id')->where('name', 'client')->first()->id;
            $user->save();
            Session::flash('msg', "user: $user->first_name  is demoted");
        } else {
            Session::flash('error', "user: $user->first_name  can't be demote");
        }
        $user->role_id = ($user->role->name == 'client') ? Role::select('id')->where('name', 'counter')->first()->id : Role::select('id')->where('name', 'client')->first()->id;
        // $user->role_id = Role::select('id')->where('name', 'client')->first()->id;
        $user->save();
        Session::flash('msg', "user: $user->first_name  is demoted");
        return back();
    }
    public function delete(User $user, Request $request)
    {
        try {
            //$user->mobiles()->delete();
            $user->delete();
            $msg = 'Client deleted successfully';
            Session::flash('msg', $msg);
        } catch (\Throwable $e) {
            $msg = "Client can't be deleted";
            Session::flash('error', $msg);
        }
        return  back();
    }
    public function removeVerify($id, Request $request)
    {
        $user = User::findOrFail($id);
        if ($user->id == $request->user()->id) {
            $error = "Trying to unverify yourself";
            Session::flash('error', $error);
            return back();
        }
        $user->email_verified_at = null;
        $user->save();
        Session::flash('msg', 'Un-verified Successfully');
        return back();
    }

    public function applyVerify($id, Request $request)
    {
        $user = User::findOrFail($id);
        if ($user->id == $request->user()->id) {
            Session::flash('error', 'Trying to verify yourself');
            return back();
        }
        $user->email_verified_at = Carbon::now();
        $user->save();
        Session::flash('msg', 'Verified Successfully');
        return back();
    }
}
