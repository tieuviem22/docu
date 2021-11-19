<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clicks', function (Blueprint $table) {
            $table->string('id',40)->primary();
            $table->bigInteger("offer_id")->unsigned();
            $table->string("ip_address");
            $table->string("sub1");
            $table->timestamp("time");
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
        Schema::dropIfExists('clicks');
    }
}
