<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imageUrl = asset('assets/images/h_logo.png');

        Setting::create(['key'       => 'app_name', 'value' => 'House Help Hub']);
        Setting::create(['key'       => 'app_logo', 'value' => $imageUrl]);
        Setting::create(['key'       => 'email', 'value' => 'househelphub@gmail.com']);
        Setting::create(['key'       => 'address', 'value' => '16/A saint Joseph Park']);
        Setting::create(['key'       => 'phone', 'value' => '9876543210']);
        Setting::create(['key'       => 'city', 'value' => 'Surat']);
        Setting::create(['key'       => 'state', 'value' => 'Gujarat']);
        Setting::create(['key'       => 'country', 'value' => 'India']);

    }
}
