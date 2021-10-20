<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('actor_id', 22);
            $table->string('receiver_id', 22);
            $table->string('type', 55);
            $table->string('message', 500);
            $table->string('status', 22);
            $table->string('main_foreign_key', 22);
            $table->string('sub_foreign_keys', 22)->nullable();
            $table->timestamp('timestamp')->default('current_timestamp()');
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
        Schema::dropIfExists('notifications');
    }
}
