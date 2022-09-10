<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default('1')
                ->comment('0 => inactive, 1 => active');
            $table->timestamps();
        });
        Schema::create('client_translations', function(Blueprint $table)
        {
            $table->increments('clients_trans_id');
            $table->bigInteger('client_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->text('desc');
            $table->unique(['client_id','locale']);
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
