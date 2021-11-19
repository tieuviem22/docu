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
            "id" => "fajalkfahahfhkafkak",
            "offer_id" => "1",
            "click_id" => "618e8cdff92ca00001eadd50",
            "payout" => "1",
            "time" => Carbon::now('Asia/Ho_Chi_Minh')
        ]);
    }
}
