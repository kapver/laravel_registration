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
        $countriesJson = Storage::get('fixtures/countries.json');
        $countries = json_decode($countriesJson, true);
        Country::insert($countries);
    }
}
