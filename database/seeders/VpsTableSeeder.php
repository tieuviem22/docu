<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Models\Vps;


class VpsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Vps::create([
            'vps_name' => "vps2",
            'ip_address' => "1.1.1.2",
            'proxy' => "socks5:185.21.61.60:45909:a:a:False",
            'offer_id' => "1"
        ]);
    }
}
