<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = app_path('../countries.json');
        if (file_exists($path)) {
            $countriesJson = file_get_contents($path);
            $countries = json_decode($countriesJson, true);
            Country::insert($countries);
        }
    }
}
