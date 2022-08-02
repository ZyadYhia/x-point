<?php

namespace App\Http\Controllers\Web\Client;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Web\Client\InvoiceController;

class RoomController extends Controller
{
    public function index(Room $room)
    {
        $data['room'] = $room;
        $data['room_type'] = $room->room_type->name;
        return view('dashboard.Room.index')->with($data);
    }
    public function open(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            // 'email' => 'nullable|exists:users,email',
            'room' => 'required|exists:rooms,name'
        ]);
        if ($validator->failed()) {
            Session::flash('error', 'Validations Error');
            return back()->withErrors($validator->errors());
        }
        if ($request->username) {
            $user = User::where('user_name', $request->username)->first();
        } else if ($request->email) {
            $user = User::where('user_name', $request->username)->first();
        }
        if (!$user) {
            Session::flash('error', 'User Not Found');
            return back();
        }
        if (!Hash::check($request->password, $user->password)) {
            Session::flash('error', 'Password incorrect');
            return back();
        }
        $room = Room::where('id', $request->room)->first();
        if ($room->status == 'available') {
            $room->status = 'busy';
            $room->opened_at = now();
            $room->save();
            $room->users()->attach($user->id);
            if ($room->room_type->name == 'Room PS' or $room->room_type->name == 'Open PS') {
                $room->users()->updateExistingPivot($user->id, [
                    'players' => $request->players,
                ]);
            }
        }
        Session::flash('msg', 'Room Opend Successfuly');
        return redirect(url('dashboard'));
    }
    public function close(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            // 'email' => 'nullable|exists:users,email',
            'room' => 'required|exists:rooms,name'
        ]);
        if ($validator->failed()) {
            return back();
        }
        if ($request->username) {
            $user = User::where('user_name', $request->username)->first();
        } else if ($request->email) {
            $user = User::where('user_name', $request->username)->first();
        }
        if (!$user) {
            Session::flash('error', 'Username or Email Incorrect');
            return back();
        }
        if (!Hash::check($request->password, $user->password)) {
            Session::flash('error', 'Password Incorrect');
            return back();
        }
        $room = Room::where('id', $request->room)->first();
        if ($room->status == 'busy') {
            $pivotRow = $room->users()->where('user_id', $user->id)->first();
            if ($pivotRow && $room->users[0]->id == $user->id) {
                // if ($pivotRow->pivot->players == 'single') {
                $cost = $this->calc_cost($room->opened_at, $room->cost, $room->multi);
                // $points = $this->calculate_points($cost, $room->discount);
                // $points = $this->calculate_points($cost->opened_at, $room->cost, $room->discount);
                // } else {
                //     $cost = $this->calc_cost($room->opened_at, $room->cost, $room->multi);
                //     // $points = $this->calculate_points($cost, $room->discount);
                //     // $points = $this->calculate_points($room->opened_at, $room->cost, $room->discount, 1);
                // }
                $points = $this->calculate_points($cost, $room->discount);
                $time_now = Carbon::now();
                $time_mins = $time_now->diffInMinutes($room->opened_at);
                if ($user->user_name !== 'counter') {
                    $user->points = $user->points + $points;
                }
                $room->status = 'available';
                $room->opened_at = null;
                $user->save();
                $room->save();
                $room->users()->detach();
                InvoiceController::store($user->id, $room, $cost, $time_mins);
                Session::flash('msg', 'Room Closed Successfuly');
                Session::flash('invoice', 'success');
            } else {
                Session::flash('error', 'Wrong Opening User');
            }
        }

        $data['room'] = $room->name;
        $data['cost'] = $cost;
        $data['time'] = $time_mins;
        $data['room'] = $room;
        $data['invoice'] = Invoice::with('invoice_details')->orderBy('created_at', 'DESC')->where('status', '!=', 'paid')->where('user_id', $user->id)->first();
        // $data['invoices'] = Invoice::with('invoice_details')->where('status', '!=', 'paid')->where('user_id', $user->id)->get();
        // $data['invoices'] = $user->invoices();
        // dd($data['invoices']);
        $data['room_type'] = $room->room_type->name;
        return view('dashboard.Room.index')->with($data);
        // dd($data);
        // return back()->with($data);
        // return redirect(url('dashboard'));
    }

    // public function calculate_points($opened_at, $cost, $discount, $multiple = 0)
    public function calculate_points($total_cost, $discount)
    {
        // calculate difference in minutes
        // multiple by cost of time
        // multiple by single or multi
        // $time_now = Carbon::now();
        // $time_mins = $time_now->diffInMinutes($opened_at);
        // $equation = ($cost / 60) * $time_mins;
        // $total_cost = (!$multiple) ? $equation : $equation * 1.5;
        $new_points = $total_cost * ($discount / 100);
        // dd($time_now, $time_mins, $equation, $multiple, $total_cost, $new_points);
        return $new_points;
    }
    public function calc_cost($opened_at, $cost, $multiple = 0)
    {
        $time_now = Carbon::now();
        $time_mins = $time_now->diffInMinutes($opened_at);
        $equation = ($cost / 60) * $time_mins;
        $total_cost = (!$multiple) ? $equation : $equation * $multiple;
        return $total_cost;
    }
}
