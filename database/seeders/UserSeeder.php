<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = Role::select('id')->where('name', 'superadmin')->first()->id;
        $admin = Role::select('id')->where('name', 'admin')->first()->id;
        $counter = Role::select('id')->where('name', 'counter')->first()->id;
        $client = Role::select('id')->where('name', 'client')->first()->id;
        User::create([
            'first_name' => 'Zyad',
            'last_name' => 'Yhia',
            'user_name' => 'zyad.yhia',
            'points' => null,
            'role_id' => $superadmin,
            'email' => 'zeyad.yhia95@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('ImZyadYhia.96'),
        ]);
        User::create([
            'first_name' => 'Yasser',
            'last_name' => 'Sleem',
            'user_name' => 'yasser.sleem',
            'points' => null,
            'role_id' => $admin,
            'email' => 'yasser.seleem@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ]);
        User::create([
            'first_name' => 'Hag',
            'last_name' => 'Adel',
            'user_name' => 'hag.adel',
            'points' => null,
            'role_id' => $counter,
            'email' => 'hag.adel@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ]);
        User::create([
            'first_name' => 'Ahmed',
            'last_name' => 'Atta',
            'user_name' => 'ahmed.atta',
            'points' => null,
            'role_id' => $client,
            'email' => 'ahmed.atta@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ]);
    }
}
