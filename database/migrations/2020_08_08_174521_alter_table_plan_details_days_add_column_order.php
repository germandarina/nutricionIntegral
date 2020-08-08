<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePlanDetailsDaysAddColumnOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_details_days',function (Blueprint $table) {
            $table->unsignedTinyInteger('order')->default(0)->after('day');
            $table->index(['plan_id','plan_detail_id','day','order'],'index_search');
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
            $table->dropColumn('order');
        });
    }
}
