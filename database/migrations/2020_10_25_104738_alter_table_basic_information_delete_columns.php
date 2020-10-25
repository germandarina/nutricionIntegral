<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableBasicInformationDeleteColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('basic_information',function (Blueprint $table){
            $table->dropColumn('path_logo');
            $table->dropColumn('phone');
            $table->dropColumn('cellphone');
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
            $table->string('path_logo');
            $table->string('phone');
            $table->string('cellphone');
        });
    }
}
