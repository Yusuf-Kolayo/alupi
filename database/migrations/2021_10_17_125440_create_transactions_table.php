<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('trans_id', 55);
            $table->string('client_id', 55);
            $table->string('product_id', 55);
            $table->string('pps_id', 55);
            $table->string('agent_id', 55);
            $table->integer('amount');
            $table->integer('new_bal');
            $table->string('type', 22);
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
        Schema::dropIfExists('transactions');
    }
}
