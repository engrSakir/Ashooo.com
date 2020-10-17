<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->double('three_month_price')->nullable();
            $table->double('six_month_price')->nullable();
            $table->double('twelve_month_price')->nullable();
            $table->boolean('mobile_availability')->default(1);
            $table->boolean('description_availability')->default(1);
            $table->integer('image_count')->default(1);
            $table->integer('position')->unique();
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
        Schema::dropIfExists('membership_packages');
    }
}
