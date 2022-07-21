<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentedProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rented_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customers_id');

            $table->string('product_number');
            $table->float('value');
            $table->integer('number_days');

            $table->timestamps();

            $table->foreign('customers_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rented_products');
    }
}
