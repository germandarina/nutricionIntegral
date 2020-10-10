<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertObservationsFromRecipes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            DB::beginTransaction();
                $recipes = \App\Models\Recipe::where(function($query){
                                        $query->whereNotNull('observation')
                                            ->orWhere('observation','<>','');
                                    })->get();

                foreach ($recipes as $recipe){
                    $array_observations = explode('/', $recipe->observation);
                    foreach ($array_observations as $observation_name){
                        $observation_name = str_replace('.','',trim($observation_name));

                        $observation      = \App\Models\Observation::where('name',$observation_name)->first();

                        if(!$observation){
                            $observation = new \App\Models\Observation();
                            $observation->name = $observation_name;
                            $observation->save();
                        }

                        $recipe->observations()->attach($observation);
                    }
                }

            DB::commit();
        }catch (Exception $exception){
            DB::rollBack();
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::delete('delete from observations');
    }
}
