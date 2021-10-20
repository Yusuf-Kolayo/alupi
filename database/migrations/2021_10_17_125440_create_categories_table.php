<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('cat_name', 100);
            $table->string('abbr', 11);
            $table->string('description', 1000);
            $table->string('meta_title', 500);
            $table->string('meta_desc', 1000);
            $table->string('meta_keyword', 1000);
            $table->integer('position');
            $table->string('status', 22);
            $table->integer('parent_id');
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
        Schema::dropIfExists('categories');
    }
}
