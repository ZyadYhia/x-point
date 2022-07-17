<?php

namespace App\Http\Controllers\Web\Client;

use Exception;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Mobile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $client = Role::where('name', 'client')->first();
        // $data['counters'] = User::where('role_id', $counter->id)->get();
        // if (Auth::user()->role->name == 'superadmin') {
        //     $admin = Role::where('name', 'admin')->first();
        //     $data['admins'] = User::where('role_id', $admin->id)->get();
        //     $data['isSuperadmin'] = 1;
        // } else {
        //     $data['isSuperadmin'] = 0;
        // }
        $data['counter'] = Role::select('id')->where('name', 'counter')->first();
        $data['admins'] = User::whereNot('role_id', $client->id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('dashboard.users.index')->with($data);
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
            'password' => Hash::make($request->password),
            'role_id' => $role
        ]);
        Mobile::create([
            'name' => $request->mobile,
            'user_id' => $user->id
        ]);
        Session::flash('msg', 'User Created Successfuly');
        return back();
    }

    public function promote($id, Request $request)
    {
        $admin = User::findOrFail($id);
        if ($admin->role->name == 'admin') {
            # code...
        }
        $admin->role_id = ($admin->role->name == 'admin') ? Role::select('id')->where('name', 'superadmin')->first()->id : Role::select('id')->where('name', 'admin')->first()->id;
        // $admin->role_id = Role::select('id')->where('name', 'superadmin')->first()->id;
        $admin->save();
        Session::flash('msg', "user: $admin->first_name  is promoted");
        return back();
    }
    public function demote($id, Request $request)
    {
        if (Auth::user()->id == $id) {
            Session::flash('error', "You can't demote yourself!");
            return back();
        }
        $superadmin = User::findOrFail($id);
        $superadmin->role_id = ($superadmin->role->name == 'admin') ? Role::select('id')->where('name', 'counter')->first()->id : Role::select('id')->where('name', 'admin')->first()->id;
        // $superadmin->role_id = Role::select('id')->where('name', 'admin')->first()->id;
        $superadmin->save();
        Session::flash('msg', "user: $superadmin->first_name  is demoted");
        return back();
    }
    public function delete(User $user, Request $request)
    {
        try {
            $user->mobiles()->delete();
            $user->delete();
            $msg = 'Admin deleted successfully';
            Session::flash('msg', $msg);
        } catch (Exception $e) {
            $msg = "Admin can't be deleted";
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
