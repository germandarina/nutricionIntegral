<?php

namespace App\Repositories\Backend\Admin;

use App\Models\Plan;
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
        // Make sure it doesn't already exist
//        if ($this->planExists($data['name'])) {
//            Session::flash('error','Ya existe un plan con el nombre '.$data['name']);
//            throw new GeneralException('Ya existe un plan con el nombre '.$data['name']);
//        }
        return DB::transaction(function () use ($data) {
            $plan = parent::create($data);

            if ($plan) {
                return $plan;
            }
            Session::flash('error','Error al crear plan. Intente nuevamente');
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
            Session::flash('error','No tiene permiso para realizar esta acción');
            throw new GeneralException('No tiene permiso para realizar esta acción');
        }

        // If the name is changing make sure it doesn't already exist
//        if ($plan->name !== strtolower($data['name'])) {
//            if ($this->planExists($data['name'])) {
//                Session::flash('error','Ya existe un plan con el nombre '.$data['name']);
//                throw new GeneralException('Ya existe un plan con el nombre '.$data['name']);
//            }
//        }

        return DB::transaction(function () use ($plan, $data) {
            if ($plan->update($data)) {
                return $plan;
            }
            Session::flash('error','Error al actualizar plan. Intente nuevamente');
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
            Session::flash('error','El plan no esta eliminado');
            throw new GeneralException('El plan no esta eliminado');
        }
        if ($plan->restore()) {
            return $plan;
        }
        Session::flash('error','Error al restaurar plan. Intente nuevamente');
        throw new GeneralException('Error al restaurar plan. Intente nuevamente');
    }
}
