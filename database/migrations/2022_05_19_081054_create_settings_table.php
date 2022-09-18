<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('default_image');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('youtube');
            $table->string('whatsapp');
            $table->string('help_phone');
            $table->string('management_phone');
			$table->string('android_version_user');
			$table->string('android_version_provider');
            $table->string('ios_version_user');
			$table->string('ios_version_provider');
            $table->timestamps();
        });
        Schema::create('setting_translations', function (Blueprint $table) {
            $table->increments('settings_trans_id');
            $table->bigInteger('setting_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->text('desc');
            $table->text('about');
            $table->text('terms');
            $table->text('privacy_users');
            $table->text('privacy_providers');
            $table->unique(['setting_id', 'locale']);
            $table->foreign('setting_id')->references('id')->on('settings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
