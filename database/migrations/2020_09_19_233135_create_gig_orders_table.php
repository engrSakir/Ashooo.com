<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGigOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gig_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gig_id');
            $table->foreignId('customer_id');
            $table->string('status')->default('active')->comment('active|complete|running|cancelled');
            $table->double('budget');
            $table->text('description');
            $table->string('address');
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
        Schema::dropIfExists('gig_orders');
    }
}
