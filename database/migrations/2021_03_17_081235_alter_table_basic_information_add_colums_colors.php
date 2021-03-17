<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableBasicInformationAddColumsColors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('basic_information',function (Blueprint $table)
        {
            $table->string('color_days',20)->nullable()->after('path_image');
            $table->string('color_headers',20)->nullable()->after('color_days');
            $table->string('color_observations',20)->nullable()->after('color_headers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('basic_information',function (Blueprint $table){
            $table->dropColumn('color_days');
            $table->dropColumn('color_headers');
            $table->dropColumn('color_observations');
        });
    }
}
