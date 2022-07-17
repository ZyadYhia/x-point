<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomType::create([
            'name' => 'Room PS',
        ]);
        RoomType::create([
            'name' => 'Open PS',
        ]);
        RoomType::create([
            'name' => 'Air Hocky',
        ]);
        RoomType::create([
            'name' => 'Billiard',
        ]);
        // RoomType::create([
        //     'name' => 'Air Hocky',
        //     'cost_per_game' => 10,
        // ]);
        // RoomType::create([
        //     'name' => 'Pool',
        //     'cost_per_hour' => 15,
        // ]);
        // RoomType::create([
        //     'name' => 'Open PS',
        //     'cost_per_hour' => 15,
        // ]);
        // RoomType::create([
        //     'name' => 'Room PS',
        //     'cost_per_hour' => 20,
        // ]);
    }
}
