<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructions', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default('1')
                ->comment('0 => inactive, 1 => active');
            $table->timestamps();
        });
        Schema::create('instruction_translations', function(Blueprint $table)
        {
            $table->increments('instructions_trans_id');
            $table->bigInteger('instruction_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->text('text');
            $table->unique(['instruction_id','locale']);
            $table->foreign('instruction_id')->references('id')->on('instructions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructions');
    }
}
