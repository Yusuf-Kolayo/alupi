<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_prices', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('vendor_id', 22);
            $table->string('product_id', 22);
            $table->integer('price');
            $table->timestamps()->default('current_timestamp()');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_prices');
    }
}
