<?php

namespace App\Repositories\Backend\Admin;

use App\Models\Classification;
use App\Models\Ingredient;
use App\Models\Plan;
use App\Models\PlanDetail;
use App\Models\PlanEnergySpending;
use App\Models\Recipe;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Session;

/**
 * Class PlanRepository.
 */
class PlanRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Plan::class;
    }

    /**
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return Plan
     */
    public function create(array $data) : Plan
    {
        return DB::transaction(function () use ($data) {
            $plan = parent::create($data);
            if ($plan) {
                return $plan;
            }
            throw new GeneralException('Error al crear plan. Intente nuevamente');
        });
    }

    /**
     * @param Plan  $plan
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(array $data, Plan $plan)
    {
        if (!auth()->user()->isAdmin()) {
            throw new GeneralException('No tiene permiso para realizar esta acción');
        }

        return DB::transaction(function () use ($plan, $data) {
            if($plan->days != $data['days']){
                $plan->load('details');
                if($plan->details->isNotEmpty())
                    throw new GeneralException('No puede cambiar la cantidad de días si ya tiene recetas cargadas.');
            }

            if ($plan->update($data)) {
                return $plan;
            }
            throw new GeneralException('Error al actualizar plan. Intente nuevamente');
        });
    }

    /**
     * @param $name
     *
     * @return bool
     */
    protected function planExists($name) : bool
    {
        return $this->model
            ->where('name', strtolower($name))
            ->count() > 0;
    }

    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */

    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc')
    {
        return $this->model
//            ->with('roles', 'permissions', 'providers')
            ->onlyTrashed()
            ->orderBy($orderBy, $sort);
        //->paginate($paged);
    }

    /**
     * @param Plan $plan
     *
     * @throws GeneralException
     * @return Plan
     */
    public function restore(Plan $plan) : Plan
    {
        if ($plan->deleted_at === null) {
            throw new GeneralException('El plan no esta eliminado');
        }
        if ($plan->restore()) {
            return $plan;
        }
        throw new GeneralException('Error al restaurar plan. Intente nuevamente');
    }

    public function addRecipe(array $datos)
    {
        if (!auth()->user()->isAdmin()) {
            throw new GeneralException('No tiene permiso para realizar esta acción');
        }

        $recipe = Recipe::find($datos['recipe_id']);
        $recipe->load('observations');

        $observations = $recipe->observations;

        return DB::transaction(function () use ($datos,$observations) {

            foreach ($datos['days'] as $day)
            {
                for ($i=0;$i< $datos['quantity_by_day'];$i++)
                {
                    $plan_detail            = new PlanDetail();
                    $plan_detail->plan_id   = $datos['plan_id'];
                    $plan_detail->recipe_id = $datos['recipe_id'];
                    $plan_detail->day       = $day;

                    if(!$plan_detail->save())
                        throw new GeneralException('Error al agregar receta por dia. Intente nuevamente',422);

                    $plan_detail->observations()->attach($observations);
                }
            }
        });
    }


    public function copyRecipeToEdit($recipe_original)
    {
        if (!auth()->user()->isAdmin()) {
            throw new GeneralException('No tiene permiso para realizar esta acción');
        }

        return DB::transaction(function () use ($recipe_original)
        {
              $recipe                   = new Recipe();
              $recipe->name             = $recipe_original->name;
              $recipe->recipe_type_id   = $recipe_original->recipe_type_id;
              $recipe->edit             = true;
              $recipe->origin_recipe_id = $recipe_original->edit ? $recipe_original->origin_recipe_id : $recipe_original->id;
              $recipe->save();

              foreach ($recipe_original->ingredients as $ingredient_original)
              {
                  $ingredient = new Ingredient();
                  $ingredient->fill($ingredient_original->toArray());
                  $ingredient->recipe_id = $recipe->id;
                  $ingredient->id        = null;
                  $ingredient->save();
              }

              $recipe_original->load('classifications','observations');

              $classifications_ids = $recipe_original->classifications->pluck('id');

              $recipe->classifications()->attach($classifications_ids);

              $observations = $recipe_original->observations;

              if($observations)
                  $recipe->observations()->attach($observations);

              return $recipe;
        });
    }

    public function addActivityFao(array $data, Plan $plan)
    {
        if (!auth()->user()->isAdmin()) {
            throw new GeneralException('No tiene permiso para realizar esta acción');
        }
        $data['plan_id'] = $plan->id;
        return DB::transaction(function () use ($data,$plan)
        {
            $spending_energy = PlanEnergySpending::create($data);
            if ($spending_energy)
            {
//                if($spending_energy->activity != PlanEnergySpending::act_minima_manutencion)
//                {
//                    $spending_amm = PlanEnergySpending::where('plan_id',$plan->id)->where('activity',)
//                }

                return $spending_energy;
            }

            throw new GeneralException('Error al agregar actividad. Intente nuevamente');
        });
    }

    /**
     * @param Plan $plan
     *
     * @throws GeneralException
     * @return double
     */

    public function calculateAMMValues(Plan $plan)
    {
        $plan->load('energySpendings');
        $energySpendings =  $plan->energySpendings;

        if($energySpendings->isEmpty())
            return 0;

        $weekly_average_activity = 0;
        foreach ($energySpendings as $activity)
        {
            if($activity->factor_activity == PlanEnergySpending::act_minima_manutencion){
                continue;
            }
            $weekly_average_activity += $activity->weekly_average_activity;
        }

        $amm_hours = 24 - $weekly_average_activity;

        return $amm_hours == 24 ? 0 : $amm_hours;
    }

    /**
     * @param Plan $plan
     *
     * @throws GeneralException
     * @return array
     */

    public function calculateTotalFao(Plan $plan)
    {
        $plan->load('energySpendings');
        $energySpendings =  $plan->energySpendings;

        if($energySpendings->isEmpty())
            return ['total_hours'=>0,'total_energy'=>0];

        $weekly_average_activity = 0;
        $total = 0;
        foreach ($energySpendings as $activity)
        {
            $weekly_average_activity += $activity->weekly_average_activity;
            $total += $activity->total;

        }

        return ['total_hours'=>round($weekly_average_activity,2),'total_energy'=>round($total,3)];
    }
}
