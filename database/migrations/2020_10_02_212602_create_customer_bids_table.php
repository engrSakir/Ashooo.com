<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_bids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_gig_id');
            $table->foreignId('customer_id');
            $table->string('status')->default('active')->comment('active|complete|running|cancelled');
            $table->double('budget');
            $table->text('description');
            $table->string('address');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('customer_bids');
    }
}
