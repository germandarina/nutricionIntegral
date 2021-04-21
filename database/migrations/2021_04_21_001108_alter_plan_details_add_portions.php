<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPlanDetailsAddPortions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_details', function (Blueprint $table){
            $table->unsignedTinyInteger('portions')->default(1)->after('recipe_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_details',function (Blueprint $table) {
            $table->dropColumn('portions');
        });
    }
}
