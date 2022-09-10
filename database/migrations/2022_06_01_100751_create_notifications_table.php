<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default('1')
                ->comment('0 => inactive, 1 => active');
            $table->tinyInteger('type');
            $table->tinyInteger('redirect');
            $table->timestamps();
        });
        Schema::create('notification_translations', function (Blueprint $table) {
            $table->increments('notifications_trans_id');
            $table->bigInteger('notification_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('title');
            $table->string('desc');
            $table->unique(['notification_id', 'locale']);
            $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
