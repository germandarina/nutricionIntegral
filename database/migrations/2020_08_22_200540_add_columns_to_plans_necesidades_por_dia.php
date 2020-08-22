<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToPlansNecesidadesPorDia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->double('energia_kcal_por_dia',15,3)->default(0)->after('days');
            $table->double('proteina_por_dia',15,3)->default(0)->after('energia_kcal_por_dia');
            $table->double('carbohidratos_por_dia',15,3)->default(0)->after('proteina_por_dia');
            $table->double('grasa_total_por_dia',15,3)->default(0)->after('carbohidratos_por_dia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn('energia_kcal_por_dia');
            $table->dropColumn('proteina_por_dia');
            $table->dropColumn('carbohidratos_por_dia');
            $table->dropColumn('grasa_total_por_dia');
        });
    }
}
