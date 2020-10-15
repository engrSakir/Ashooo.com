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
            $table->boolean('status')->default(1)->comment('1-Active');
            $table->string('full_name');
            $table->string('user_name')->unique();
            $table->string('phone')->unique();
            $table->string('email')->nullable();
            $table->string('image')->default('default.png');
            $table->string('gender')->comment('male|female');
            $table->foreignId('upazila_id');
            $table->string('role')->default('customer')->comment('admin|controller|worker|membership|customer');
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('last_logout_at')->nullable();
            $table->string('password');
            $table->string('reset_date')->nullable()->comment('Password reset code sending date');
            $table->integer('reset_count')->nullable()->comment('In a day how many time reset message available');
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
