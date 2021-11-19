<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversions', function (Blueprint $table) {
            $table->string('id',40)->primary();
            $table->bigInteger("offer_id")->unsigned();
            $table->string("click_id",40)->unique();
            $table->integer("payout");
            $table->timestamp("time");
            $table->timestamps();

            $table->foreign('offer_id')->references('id')->on('offers');
            $table->foreign('click_id')->references('id')->on('clicks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversions');
    }
}
