<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string("name_offer")->nullable();
            $table->bigInteger('network_id')->unsigned()->nullable();
            $table->string("url")->default("http://google.com");
            $table->bigInteger("country_id")->unsigned();
            $table->boolean("status")->default('1')->nullable();
            $table->timestamps();

            $table->foreign('network_id')->references('id')->on('networks');
            $table->foreign('country_id')->references('id')->on('countries');
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
