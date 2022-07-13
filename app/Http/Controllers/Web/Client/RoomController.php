<?php

namespace App\Http\Controllers\Web\Client;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function index(Room $room)
    {
        $data['room'] = $room;
        return view('Client.Room.index')->with($data);
    }
    public function open(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'nullable|exists:users,user_name',
            'email' => 'nullable|exists:users,email',
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

        if (!Hash::check($request->password, $user->password)) {
            return back();
        }
        $room = Room::where('id', $request->room)->first();
        if ($room->status == 'available') {
            $room->status = 'busy';
            $room->opened_at = now();
            $room->save();
            $room->users()->attach($user->id);
        }
        return redirect('dashboard');
    }
    public function close(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'nullable|exists:users,user_name',
            'email' => 'nullable|exists:users,email',
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

        if (!Hash::check($request->password, $user->password)) {
            return back();
        }
        $room = Room::where('id', $request->room)->first();
        if ($room->status == 'busy') {
            $pivotRow = $room->users()->where('user_id', $user->id)->first();
            if ($pivotRow && $room->users[0]->id == $user->id) {
                $room->status = 'available';
                $room->opened_at = null;
                $room->save();
                $room->users()->detach();
            }
        }
        return redirect('dashboard');
    }
}
