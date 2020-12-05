<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanEnergySpending extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_energy_spending', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plan_id');
            $table->decimal('tmb',10,3);
            $table->unsignedTinyInteger('hours');
            $table->unsignedTinyInteger('days');
            $table->decimal('weekly_average_activity',10,2);
            $table->decimal('activity',10,2);
            $table->decimal('factor_activity',10,2);
            $table->decimal('total',10,3);
            $table->string('created_by');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('plan_id')->on('plans')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_energy_spending');
    }
}
