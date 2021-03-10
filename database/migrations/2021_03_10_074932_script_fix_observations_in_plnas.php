<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\Models\Recipe;

class ScriptFixObservationsInPlnas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $recipes = Recipe::has('observations')
                        ->has('planDetails')
                        ->with(['observations','planDetails.observations'])
                        ->get();

        foreach ($recipes as $recipe)
        {
            foreach ($recipe->planDetails as $detail)
            {
                if($detail->observations->isEmpty())
                {
                    $detail->observations()->attach($recipe->observations);
                }
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
