<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatchmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catchments', function (Blueprint $table) {
            $table->id();
            $table->string('catchment_id', 22);
            $table->string('locations', 100);
            $table->string('lga', 55);
            $table->string('state_name', 55);
            $table->integer('state_index');
            $table->string('description', 100);
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
        Schema::dropIfExists('catchments');
    }
}
