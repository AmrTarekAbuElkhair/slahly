<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default('1')
                ->comment('0 => inactive, 1 => active');
            $table->string('image');
            $table->string('price');
            $table->timestamps();
        });
        Schema::create('package_translations', function(Blueprint $table)
        {
            $table->increments('packages_trans_id');
            $table->bigInteger('package_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->unique(['package_id','locale']);
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
