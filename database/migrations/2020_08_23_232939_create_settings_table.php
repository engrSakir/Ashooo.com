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
            $table->string('name')->default('Ashooo');
            $table->string('logo')->default('logo.png');
            $table->string('logo_login')->default('logo-login.png');
            $table->string('logo_login_white')->default('logo-login-white.png');
            $table->string('logo_header')->default('logo-header.png');
            $table->string('logo_header_white')->default('logo-header-white.png');
            $table->string('search')->default('search.png');
            $table->string('fav')->default('default.png');
            $table->string('motto')->default('service marketplace');

            $table->string('sms_username')->nullable()->comment('SMS API User name | alpha.net.bd/SMS');
            $table->string('sms_key')->nullable()->comment('SMS API User hash | alpha.net.bd/SMS');

            $table->integer('reset_sms_count')->nullable()->default(3)->comment('Per day available reset message');
            $table->string('reset_sms_template')->nullable()->default('আপনার নতুন পাসওয়ার্ডঃ ')->comment('Password sms template');
            $table->string('welcome_sms_template')->nullable()->default('স্বাগতম')->comment('Welcome sms template');

            $table->timestamps();
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
