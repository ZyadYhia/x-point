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
        $Billiard = RoomType::where('name', 'Billiard')->first();
        $Open_PS = RoomType::where('name', 'Open PS')->first();
        $Room_PS = RoomType::where('name', 'Room PS')->first();

        Room::create([
            'name' => 'Cinema Room',
            'room_type_id' => $Room_PS->id,
            'cost' => 50,
            'discount' => 10,
        ]);
        Room::create([
            'name' => 'VIP Room',
            'room_type_id' => $Room_PS->id,
            'cost' => 40,
            'discount' => 10,
        ]);
        Room::create([
            'name' => 'X 1',
            'room_type_id' => $Room_PS->id,
            'cost' => 30,
            'discount' => 10,
        ]);
        Room::create([
            'name' => 'X 2',
            'room_type_id' => $Room_PS->id,
            'cost' => 30,
            'discount' => 10,
        ]);
        Room::create([
            'name' => 'X 3',
            'room_type_id' => $Room_PS->id,
            'cost' => 30,
            'discount' => 10,
        ]);
        Room::create([
            'name' => 'O 1',
            'room_type_id' => $Open_PS->id,
            'cost' => 25,
            'discount' => 10,
        ]);
        Room::create([
            'name' => 'O 2',
            'room_type_id' => $Open_PS->id,
            'cost' => 25,
            'discount' => 10,
        ]);
        Room::create([
            'name' => 'O 3',
            'room_type_id' => $Open_PS->id,
            'cost' => 25,
            'discount' => 10,
        ]);
        Room::create([
            'name' => 'Air Hockey',
            'room_type_id' => $airhocky->id,
            'cost' => 60,
            'discount' => 10,
        ]);
        Room::create([
            'name' => 'Billiard',
            'room_type_id' => $Billiard->id,
            'cost' => 50,
            'discount' => 10,
        ]);
    }
}
