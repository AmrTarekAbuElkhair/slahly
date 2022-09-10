<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default('1')
                ->comment('0 => inactive, 1 => active');
            $table->timestamps();
        });
        Schema::create('type_translations', function(Blueprint $table)
        {
            $table->increments('types_trans_id');
            $table->bigInteger('type_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->unique(['type_id','locale']);
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
