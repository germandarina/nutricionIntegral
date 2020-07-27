<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePlanDetailsDaysAddColumnPlanId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_details_days',function (Blueprint $table){
           $table->unsignedBigInteger('plan_id')->nullable()->after('id');
           $table->foreign('plan_id')->on('plans')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_details_days',function (Blueprint $table){
            $table->dropForeign('plan_details_days_plan_id_foreign');
            $table->dropIndex('plan_details_days_plan_id_foreign');
            $table->dropColumn('plan_id');
        });
    }
}
