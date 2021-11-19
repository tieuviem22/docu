<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vps', function (Blueprint $table) {
            $table->id();
            $table->string("vps_name");
            $table->string("ip_address");
            $table->string("proxy");
            $table->bigInteger("offer_id")->unsigned();
            $table->timestamps();

            $table->foreign('offer_id')->references('id')->on('offers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vps');
    }
}
