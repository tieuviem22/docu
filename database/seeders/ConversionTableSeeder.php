<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Models\Conversion;
use Carbon\Carbon;

class ConversionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Conversion::create([
            "id" => "fffajalkfahahfhkafkak",
            "offer_id" => "1",
            "click_id" => "118e8cdff92ca00001eadd508",
            "payout" => "1",
            "time" => Carbon::now('America/New_York')
        ]);
        Conversion::create([
            "id" => "ddfajalkfahahfhkafkak",
            "offer_id" => "1",
            "click_id" => "218e8cdff92ca00001eadd508",
            "payout" => "1",
            "time" => Carbon::now('America/New_York')
        ]);
    }
}
