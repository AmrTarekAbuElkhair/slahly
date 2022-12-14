<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_offers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('offer_id')->unsigned();
            $table->bigInteger('provider_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provider_offers');
    }
}
