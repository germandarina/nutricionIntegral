<?php

use App\Models\Recipe;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixRecipesEditInPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $recipes_edit = Recipe::where('edit',true)->get();

        foreach ($recipes_edit as $recipe_edit)
        {
            $recipe_edit->load('planDetails');

//            if($recipe_edit->planDetails->isEmpty())
//            {
//                $recipe_edit->forceDelete();
//            }

            $origin_recipe = Recipe::where('name',$recipe_edit->name)->first();

            if($origin_recipe)
            {
                $recipe_edit->origin_recipe_id = $origin_recipe->id;
                $recipe_edit->save();
            }

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
