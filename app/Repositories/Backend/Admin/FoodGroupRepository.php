<?php

namespace App\Repositories\Backend\Admin;

use App\Models\FoodGroup;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Session;

/**
 * Class FoodGroupRepository.
 */
class FoodGroupRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return FoodGroup::class;
    }

    /**
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return FoodGroup
     */
    public function create(array $data) : FoodGroup
    {
        // Make sure it doesn't already exist
        if ($this->foodGroupExists($data['name'])) {
            throw new GeneralException('Ya existe un grupo de alimento con el nombre '.$data['name']);
        }

        return DB::transaction(function () use ($data) {
            $foodGroup = parent::create($data);

            if ($foodGroup) {
                return $foodGroup;
            }
            throw new GeneralException('Error al crear grupo de alimento. Intente nuevamente');
        });
    }

    /**
     * @param FoodGroup  $foodGroup
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(array $data, FoodGroup $foodGroup)
    {
        if (!auth()->user()->isAdmin()) {
            throw new GeneralException('No tiene permiso para realizar esta acción');
        }

        // If the name is changing make sure it doesn't already exist
        if ($foodGroup->name !== strtolower($data['name'])) {
            if ($this->foodGroupExists($data['name'])) {
                throw new GeneralException('Ya existe un grupo de alimento con el nombre '.$data['name']);
            }
        }

        return DB::transaction(function () use ($foodGroup, $data) {
            if ($foodGroup->update($data)) {
                return $foodGroup;
            }
            throw new GeneralException('Error al actualizar grupo de alimento. Intente nuevamente');
        });
    }

    /**
     * @param $name
     *
     * @return bool
     */
    protected function foodGroupExists($name) : bool
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
     * @param FoodGroup $foodGroup
     *
     * @throws GeneralException
     * @return FoodGroup
     */
    public function restore(FoodGroup $foodGroup) : FoodGroup
    {
        if (is_null($foodGroup->deleted_at)) {
            throw new GeneralException('El grupo de alimento no esta eliminado');
        }
        if ($foodGroup->restore()) {
            return $foodGroup;
        }
        throw new GeneralException('Error al restaurar grupo de alimento. Intente nuevamente');
    }
}
