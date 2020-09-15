<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFoodsDropColumnEnergiaKj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('foods',function (Blueprint  $table){
            $table->dropColumn('energia_kj');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('foods',function (Blueprint  $table){
            $table->double('energia_kj',15,3)->default(0)->after('deleted_at');
        });
    }
}
