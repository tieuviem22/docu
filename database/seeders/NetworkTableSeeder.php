<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Models\Network;

class NetworkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Network::create([
            'name_network' => 'Adswapper',
            'temp_url' => 'https://adswapper.g2afse.com/click?pid=260&offer_id={offerid}&sub1={clickid}&sub5={sourceid}',
            'source_id' => '123456qwerty',
            'status' => false
        ]);
    }
}
