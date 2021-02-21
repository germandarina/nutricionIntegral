<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableRecipesAddColumnOriginRecipeId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipes',function (Blueprint $table)
        {
            $table->unsignedBigInteger('origin_recipe_id')->nullable()->default(NULL);
            $table->foreign('origin_recipe_id')->references('id')->on('recipes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipes',function (Blueprint $table)
        {
            $table->dropForeign('table_recipes_origin_recipe_id_foreign');
            $table->dropIndex('table_recipes_origin_recipe_id_foreign');
            $table->dropColumn('origin_recipe_id');
        });
    }
}
