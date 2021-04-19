<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePlansAddColumIsDuplicateAndOriginPlanId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plans',function (Blueprint $table){
            $table->boolean('duplicate')->default(false)->after('method_result');
            $table->unsignedBigInteger('origin_plan_id')->nullable()->after('duplicate')->default(null);

            $table->foreign('origin_plan_id')->references('id')->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans',function (Blueprint $table){
            $table->dropColumn('duplicate');
            $table->dropForeign('plans_origin_plan_id_foreign');
            $table->dropIndex('plans_origin_plan_id_foreign');
            $table->dropColumn('origin_plan_id');
        });
    }
}
