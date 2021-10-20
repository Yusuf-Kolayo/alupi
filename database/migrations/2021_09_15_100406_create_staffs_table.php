<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffsTable extends Migration
{
   
    
    
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id', 22)->unique('agent_id');
            $table->string('referrer_id', 22)->nullable();
            $table->string('catchment_id', 55);
            $table->string('agt_first_name', 55);
            $table->string('agt_last_name', 55);
            $table->string('agt_other_name', 55);
            $table->string('agt_phone_number', 22);
            $table->string('agt_chat_number', 22);
            $table->string('agt_gender', 11);
            $table->string('agt_res_address', 100);
            $table->string('agt_res_city', 22)->nullable();
            $table->string('agt_res_state', 22)->nullable();
            $table->string('agt_state_origin', 22)->nullable();
            $table->string('agt_lga_origin', 22)->nullable();
            $table->string('agt_home_town', 22)->nullable();
            $table->date('agt_birth_date')->nullable();
            $table->string('agt_birth_place', 22)->nullable();
            $table->string('nok_fullname', 100)->nullable();
            $table->string('nok_res_address', 100)->nullable();
            $table->string('nok_res_city', 22)->nullable();
            $table->string('nok_res_state', 22)->nullable();
            $table->string('nok_phone_number', 22)->nullable();
            $table->string('nok_relationship', 22)->nullable();
            $table->string('grt_first_name', 55)->nullable();
            $table->string('grt_last_name', 55)->nullable();
            $table->string('grt_other_name', 55)->nullable();
            $table->string('grt_phone_number', 22)->nullable();
            $table->integer('grt_age')->nullable();
            $table->string('grt_res_address', 100)->nullable();
            $table->string('grt_res_city', 22)->nullable();
            $table->string('grt_res_state', 22)->nullable();
            $table->string('grt_occupation', 55)->nullable();
            $table->string('grt_bis_name', 55)->nullable();
            $table->string('grt_bis_address', 100)->nullable();
            $table->string('grt_relationship', 22)->nullable();
            $table->text('grt_undertaken')->nullable();
            $table->string('hr_staff_id', 55)->nullable();
            $table->string('hr_grt_response', 500)->nullable();
            $table->string('hr_remark', 500)->nullable();
            $table->string('actor_id', 22);
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
        Schema::dropIfExists('staffs');
    }
}
