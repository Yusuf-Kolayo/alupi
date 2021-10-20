<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('product_id', 22);
            $table->string('prd_name', 100);
            $table->text('description');
            $table->integer('price');
            $table->string('img_name', 1000);
            $table->integer('sub_category_id');
            $table->integer('main_category_id');
            $table->integer('brand_id');
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
        Schema::dropIfExists('products');
    }
}
