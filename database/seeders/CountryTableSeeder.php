<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Models\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Country::create([
            'name_country' => 'United States',
            'iso_code' => 'US'
        ]);
    }
}
