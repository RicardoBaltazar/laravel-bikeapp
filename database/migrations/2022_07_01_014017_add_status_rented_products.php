<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusRentedProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // php artisan make:migration add_status_rented_products --table=rented_products
        Schema::table('rented_products', function (Blueprint $table) {
            $table->string('status')->default('1')->after('number_days');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rented_products', function (Blueprint $table) {
            //
        });
    }
}
