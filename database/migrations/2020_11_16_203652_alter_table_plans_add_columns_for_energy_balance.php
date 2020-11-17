<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePlansAddColumnsForEnergyBalance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plans',function (Blueprint $table)
        {
            $table->unsignedTinyInteger('method')->nullable()->after('open');
            $table->decimal('weight',10,2)->nullable()->after('method');
            $table->decimal('height',10,2)->nullable()->after('weight');
            $table->unsignedInteger('age')->nullable()->after('height');
            $table->decimal('activity',10,2)->nullable()->after('age');
            $table->decimal('method_result',10,2)->nullable()->after('activity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans',function (Blueprint $table)
        {
            $table->dropColumn('method');
            $table->dropColumn('weight');
            $table->dropColumn('height');
            $table->dropColumn('age');
            $table->dropColumn('activity');
            $table->dropColumn('method_result');
        });
    }
}
