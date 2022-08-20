<?php

namespace App\Http\Controllers\Web\Admin;

use Exception;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function index()
    {
        $data['room'] = RoomType::select('id', 'name')->where('name', 'Room PS')->first();
        $data['open'] = RoomType::select('id', 'name')->where('name', 'Open PS')->first();
        $data['Billiard'] = RoomType::select('id', 'name')->where('name', 'Billiard')->first();
        $data['air'] = RoomType::select('id', 'name')->where('name', 'Air Hocky')->first();
        $data['rooms'] = Room::where('room_type_id', $data['room']->id)->get();
        $data['opens'] = Room::where('room_type_id', $data['open']->id)->get();
        $data['Billiards'] = Room::where('room_type_id', $data['Billiard']->id)->get();
        $data['air_hockies'] = Room::where('room_type_id', $data['air']->id)->get();
        return view('dashboard.Admin.Room.index')->with($data);
    }
    public function show($id)
    {
        $data['room'] = Room::where('id', $id)->first();
        return view('dashboard.Admin.Room.edit')->with($data);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_type_id' => 'required|exists:room_types,id',
            'name' => 'required',
            'cost' => 'required',
            'points' => 'required',
            'multi' => 'required',
            'minimum_cost' => 'required',
        ]);
        if ($validator->failed()) {
            Session::flash('error', 'Validations Error');
            return back()->withErrors($validator->errors());
        }
        $room = Room::create([
            'name' => $request->name,
            'cost' => $request->cost,
            'discount' => $request->points,
            'multi' => $request->multi,
            'room_type_id' => $request->room_type_id,
            'minimum_cost' => $request->room_type_id,
        ]);
        Session::flash('msg', $room->name . ' Created Successfuly');
        return back();
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:rooms,id',
            'name' => 'required',
            'cost' => 'required',
            'points' => 'required',
            'multi' => 'required',
            'minimum_cost' => 'required',
        ]);
        if ($validator->failed()) {
            Session::flash('error', 'Validations Error');
            return back()->withErrors($validator->errors());
        }
        $room = Room::where('id', $request->id)->first();
        $room->name = $request->name;
        $room->cost = $request->cost;
        $room->minimum_cost = $request->minimum_cost;
        $room->discount = $request->points;
        $room->multi = $request->multi;
        $room->save();
        Session::flash('msg', $room->name . ' Updated Successfuly');
        return back();
    }
    public function delete(Request $request, Room $room)
    {
        try {
            $roomName = $room->name;
            $room->delete();
            $msg = $roomName . ' deleted successfully';
            Session::flash('msg', $msg);
        } catch (\Throwable $e) {
            $msg = "row can't br deleted";
            Session::flash('error', $msg);
        }
        return back();
    }
}
