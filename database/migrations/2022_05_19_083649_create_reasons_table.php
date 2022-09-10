<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reasons', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default('1')
                ->comment('0 => inactive, 1 => active');
            $table->timestamps();
        });
        Schema::create('reason_translations', function(Blueprint $table)
        {
            $table->increments('reasons_trans_id');
            $table->bigInteger('reason_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->text('text');
            $table->unique(['reason_id','locale']);
            $table->foreign('reason_id')->references('id')->on('reasons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reasons');
    }
}
