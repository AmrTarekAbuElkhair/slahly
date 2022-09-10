<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('title_translations', function(Blueprint $table)
        {
            $table->increments('titles_trans_id');
            $table->bigInteger('title_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('title');
            $table->unique(['title_id','locale']);
            $table->foreign('title_id')->references('id')->on('titles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('titles');
    }
}
