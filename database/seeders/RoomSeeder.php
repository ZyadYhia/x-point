<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $airhocky = RoomType::where('name', 'Air Hocky')->first();
        $Pool = RoomType::where('name', 'Pool')->first();
        $Open_PS = RoomType::where('name', 'Open PS')->first();
        $Room_PS = RoomType::where('name', 'Room PS')->first();

        Room::create([
            'name' => 'Air Hocky 1',
            'room_type_id' => $airhocky->id,
        ]);
        Room::create([
            'name' => 'Air Hocky 2',
            'room_type_id' => $airhocky->id,
        ]);
        Room::create([
            'name' => 'Pool',
            'room_type_id' => $Pool->id,
        ]);
        Room::create([
            'name' => 'Open 1',
            'room_type_id' => $Open_PS->id,
        ]);
        Room::create([
            'name' => 'Open 2',
            'room_type_id' => $Open_PS->id,
        ]);
        Room::create([
            'name' => 'Room 1',
            'room_type_id' => $Room_PS->id,
        ]);
        Room::create([
            'name' => 'Room 2',
            'room_type_id' => $Room_PS->id,
        ]);
        Room::create([
            'name' => 'Room 3',
            'room_type_id' => $Room_PS->id,
        ]);
        Room::create([
            'name' => 'Room 4',
            'room_type_id' => $Room_PS->id,
        ]);
        Room::create([
            'name' => 'Room 5',
            'room_type_id' => $Room_PS->id,
        ]);
    }
}
