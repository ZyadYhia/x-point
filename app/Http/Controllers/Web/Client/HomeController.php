<?php

namespace App\Http\Controllers\Web\Client;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['room'] = RoomType::select('id', 'name')->where('name', 'Room PS')->first();
        $data['open'] = RoomType::select('id', 'name')->where('name', 'Open PS')->first();
        $data['pool'] = RoomType::select('id', 'name')->where('name', 'Billiard')->first();
        $data['air'] = RoomType::select('id', 'name')->where('name', 'Air Hocky')->first();
        $data['rooms'] = Room::where('room_type_id', $data['room']->id)->get();
        $data['opens'] = Room::where('room_type_id', $data['open']->id)->get();
        $data['pools'] = Room::where('room_type_id', $data['pool']->id)->get();
        $data['air_hockies'] = Room::where('room_type_id', $data['air']->id)->get();
        return view('dashboard.home.index')->with($data);
    }
}
