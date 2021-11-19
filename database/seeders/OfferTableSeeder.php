<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Models\Offer;

class OfferTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Offer::create([
            "name_offer" => "Healthy Adswapper",
            "network_id" => 2,
            "url" => "https://adswapper.g2afse.com/click?pid=260&offer_id=79&sub1={clickid}&sub5={sourceid}",
            "country_id" => 1,
            "status" => true
        ]);
    }
}
