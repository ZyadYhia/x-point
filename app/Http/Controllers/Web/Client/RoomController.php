<?php

namespace App\Http\Controllers\Web\Client;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
            return back();
        }
        if (!Hash::check($request->password, $user->password)) {
            return back();
        }
        $room = Room::where('id', $request->room)->first();
        if ($room->status == 'busy') {
            $pivotRow = $room->users()->where('user_id', $user->id)->first();
            if ($pivotRow && $room->users[0]->id == $user->id) {
                if ($pivotRow->pivot->players == 'single') {
                    $points = $this->calculate_points($room->opened_at, $room->cost, $room->discount);
                    // dd($room->opened_at, $room->cost, $points);
                } else {
                    $points = $this->calculate_points($room->opened_at, $room->cost, $room->discount, 1);
                    // dd($room->opened_at, $room->cost, $points);
                }
                $user->points = $user->points + $points;
                $room->status = 'available';
                $room->opened_at = null;
                $user->save();
                $room->save();
                $room->users()->detach();
                Session::flash('msg', 'Room Closed Successfuly');
            } else {
                Session::flash('error', 'Wrong Opening User');
            }
        }
        return redirect(url('dashboard'));
    }

    public function calculate_points($opened_at, $cost, $discount, $multiple = 0)
    {
        // calculate difference in minutes
        // multiple by cost of time
        // multiple by single or multi
        $time_now = Carbon::now();
        $time_mins = $time_now->diffInMinutes($opened_at);
        $equation = ($cost / 60) * $time_mins;
        $total_cost = (!$multiple) ? $equation : $equation * 1.5;
        $new_points = $total_cost * ($discount/100);
        // dd($time_now, $time_mins, $equation, $multiple, $total_cost, $new_points);
        return $new_points;
    }
}
