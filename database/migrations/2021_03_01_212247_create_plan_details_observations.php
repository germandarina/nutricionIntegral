<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanDetailsObservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observation_plan_detail', function (Blueprint $table)
        {
            $table->unsignedBigInteger('observation_id');
            $table->unsignedBigInteger('plan_detail_id');

            $table->foreign('plan_detail_id')->references('id')->on('plan_details');
            $table->foreign('observation_id')->references('id')->on('observations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_details_observations');
    }
}
