<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteFieldCaloriasFromFoodsAndRecipes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->dropColumn('calorias');
        });

        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn('total_calorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->double('calorias')->default(0);
        });

        Schema::table('recipes', function (Blueprint $table) {
            $table->double('total_calorias')->default(0);
        });
    }
}
