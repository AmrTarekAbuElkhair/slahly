<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('mobile');
            $table->double('rate')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->bigInteger('service_id')->unsigned()->nullable();
            $table->bigInteger('type_id')->unsigned()->nullable();
            $table->bigInteger('country_id')->unsigned();
            $table->string('city');
            $table->rememberToken();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('verified_status')
                ->default('0')
                ->comment('0 => not verified, 1 => verified');
            $table->tinyInteger('status')
                ->default('1')
                ->comment('0 => not active, 1 => active');
            $table->string('image')->default('user.png');
            $table->tinyInteger('available')
                ->comment('0 => not available, 1 => available')->nullable();
            $table->string('firebase_token')->nullable();
            $table->string('bio')->nullable();
            $table->tinyInteger('gender')
                ->comment('0 =>male, 1 => female')->nullable();
            $table->timestamps();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
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
        Schema::dropIfExists('users');
    }
}
