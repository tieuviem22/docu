<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Models\Click;
use Carbon\Carbon;

class ClickTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Click::create([
            'id' => '618e8cdff92ca00001eadd508',
            'offer_id' => 1,
            'ip_address' => '127.0.0.1',
            'sub1' => '1111',
            'time' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);
    }
}
