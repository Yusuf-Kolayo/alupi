<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPurchaseSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_purchase_sessions', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('pps_id', 22);
            $table->string('product_id', 55);
            $table->string('client_id', 55);
            $table->string('agent_id', 55);
            $table->string('status', 22);
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
        Schema::dropIfExists('product_purchase_sessions');
    }
}
