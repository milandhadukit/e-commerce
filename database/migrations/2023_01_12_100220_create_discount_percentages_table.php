<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountPercentagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_percentages', function (Blueprint $table) {
            $table->id();
            $table->text('tc');
            $table->string('coupon')->nullable();
            $table->string('discount_percentage')->nullable();
            $table->integer('active_percentage')->default(1)->comment('active=1,close=0');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
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
        Schema::dropIfExists('discount_percentages');
    }
}
