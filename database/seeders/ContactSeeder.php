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
            'mobile' => '01555048058',
            'VF_Cash' => '01010053638',
            'email' => 'info@xpoint.epic-techs.com',
            'fb' => 'https://www.facebook.com/X-point-104897912287633',
            'linktr' => 'https://linktr.ee/xpoint_damietta',
            'youtube' => '',
            'instagram' => 'https://www.instagram.com/xpoint_damietta/'
        ]);
    }
}
