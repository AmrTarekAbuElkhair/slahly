<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')
                ->default('1')
                ->comment('0 => inactive, 1 => active');
            $table->integer('digits');
            $table->string('logo');
            $table->string('code');
            $table->timestamps();
        });
        Schema::create('country_translations', function(Blueprint $table)
        {
            $table->id('countries_trans_id');
            $table->bigInteger('country_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->unique(['country_id','locale']);
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
