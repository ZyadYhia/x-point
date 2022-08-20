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
            'points' => 0,
            'role_id' => $superadmin,
            'email' => 'zeyad.yhia95@gmail.com',
            'mobile' => '01002401163',
            'email_verified_at' => now(),
            'password' => Hash::make('ImZyadYhia.96'),
        ]);
        User::create([
            'first_name' => 'Yasser',
            'last_name' => 'Sleem',
            'user_name' => 'yasser.sleem',
            'points' => 0,
            'role_id' => $admin,
            'email' => 'yasser.seleem@gmail.com',
            'mobile' => '01010053638',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ]);
        User::create([
            'first_name' => 'Hag',
            'last_name' => 'Adel',
            'user_name' => 'hag.adel',
            'points' => 0,
            'role_id' => $counter,
            'email' => 'hag.adel@gmail.com',
            'mobile' => '',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ]);
        User::create([
            'first_name' => 'Ahmed',
            'last_name' => 'Atta',
            'user_name' => 'ahmed.atta',
            'points' => 0,
            'role_id' => $client,
            'email' => 'ahmed.atta@gmail.com',
            'mobile' => '01552031437',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ]);
        User::create([
            'first_name' => 'Counter',
            'last_name' => 'X-Point',
            'user_name' => 'counter',
            'points' => 0,
            'role_id' => $counter,
            'email' => 'counter@xpoint.com',
            'mobile' => '',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ]);
    }
}
