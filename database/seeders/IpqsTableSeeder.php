<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Models\Ipqs;
use Carbon\Carbon;

class IpqsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Ipqs::create([
            "api_key" => "pTylvltSkzfHrMPOepwVkJGki2gFkYTs",
            "date" => Carbon::parse('2021/11/15'),
            "error_status" => "You have exceeded your request quota of 200 per day. Please upgrade to increase your request quota."
        ]);
    }
}
