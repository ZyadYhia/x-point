<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mobile;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MobileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $zyad = User::select('id')->where('user_name', 'zyad.yhia')->first();
        $yasser = User::select('id')->where('user_name', 'yasser.sleem')->first();
        Mobile::create([
            'name' => '01002401163',
            'user_id' => $zyad->id
        ]);
        Mobile::create([
            'name' => '01550007037',
            'user_id' => $zyad->id
        ]);
        Mobile::create([
            'name' => '01010053638',
            'user_id' => $yasser->id
        ]);
    }
}
