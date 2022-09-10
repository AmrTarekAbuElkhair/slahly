<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default('1')
                ->comment('0 => inactive, 1 => active');
            $table->string('icon');
            $table->timestamps();
        });
        Schema::create('service_translations', function(Blueprint $table)
        {
            $table->increments('services_trans_id');
            $table->bigInteger('service_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->text('desc');
            $table->unique(['service_id','locale']);
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
