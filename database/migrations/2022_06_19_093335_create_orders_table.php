<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('provider_id')->unsigned()->nullable();
            $table->bigInteger('package_id')->unsigned()->nullable();
            $table->bigInteger('service_id')->unsigned();
            $table->bigInteger('offer_id')->unsigned()->nullable();
            $table->string('mobile');
            $table->string('order_number');
            $table->string('price')->default('0');
            $table->tinyInteger('status')->default('0')
                ->comment('0 => new, 1 => in way, 2=> in processing, 3=> finish, 4=> done,-1 => cancelled');
            $table->tinyInteger('payment_status')->default('0')
                ->comment('0 => not paid yet, 1 => paid');
            $table->string('payment');
            $table->time('time')->nullable();
            $table->date('date')->nullable();
            $table->time('visit_time')->nullable();
            $table->date('visit_date')->nullable();
            $table->time('finish_time')->nullable();
            $table->double('working_hours')->nullable();
            $table->string('title');
            $table->string('city');
            $table->string('lat');
            $table->string('lng');
            $table->text('notes');
            $table->string('apartment_no');
            $table->string('floor_no');
            $table->string('mark');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
