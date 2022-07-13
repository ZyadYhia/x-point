<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::create([
            'mobile' => '01010053638',
            'email' => 'contact@x-points.com',
            'fb' => 'https://www.facebook.com/profile.php?id=100000730460125',
            'twitter' => '',
            'youtube' => '',
            'instagram' => 'https://www.instagram.com/yasserahmedsleem/?hl=en'
        ]);
    }
}
