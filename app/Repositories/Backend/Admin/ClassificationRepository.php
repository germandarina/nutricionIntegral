<?php

namespace App\Repositories\Backend\Admin;

use App\Models\Classification;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Session;

/**
 * Class ClassificationRepository.
 */
class ClassificationRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Classification::class;
    }

    /**
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return Classification
     */
    public function create(array $data) : Classification
    {
        // Make sure it doesn't already exist
        if ($this->classificationExists($data['name'])) {
            Session::flash('error','Ya existe un clasificacion con el nombre '.$data['name']);
            throw new GeneralException('Ya existe un clasificacion con el nombre '.$data['name']);
        }
        return DB::transaction(function () use ($data) {
            $clasification = parent::create($data);

            if ($clasification) {
                return $clasification;
            }
            Session::flash('error','Error al crear clasificacion. Intente nuevamente');
            throw new GeneralException('Error al crear clasificacion. Intente nuevamente');
        });
    }

    /**
     * @param Classification  $clasification
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(array $data, Classification $clasification)
    {
        if (!auth()->user()->isAdmin()) {
            Session::flash('error','No tiene permiso para realizar esta acción');
            throw new GeneralException('No tiene permiso para realizar esta acción');
        }

        // If the name is changing make sure it doesn't already exist
        if (strtolower($clasification->name) !== strtolower($data['name'])) {
            if ($this->classificationExists($data['name'])) {
                Session::flash('error','Ya existe un clasificacion con el nombre '.$data['name']);
                throw new GeneralException('Ya existe un clasificacion con el nombre '.$data['name']);
            }
        }

        return DB::transaction(function () use ($clasification, $data) {
            if ($clasification->update($data)) {
                return $clasification;
            }
            Session::flash('error','Error al actualizar clasificacion. Intente nuevamente');
            throw new GeneralException('Error al actualizar clasificacion. Intente nuevamente');
        });
    }

    /**
     * @param $name
     *
     * @return bool
     */
    protected function classificationExists($name) : bool
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
     * @param Classification $clasification
     *
     * @throws GeneralException
     * @return Classification
     */
    public function restore(Classification $clasification) : Classification
    {
        if ($clasification->deleted_at === null) {
            Session::flash('error','El clasificacion no esta eliminado');
            throw new GeneralException('El clasificacion no esta eliminado');
        }
        if ($clasification->restore()) {
            return $clasification;
        }
        Session::flash('error','Error al restaurar clasificacion. Intente nuevamente');
        throw new GeneralException('Error al restaurar clasificacion. Intente nuevamente');
    }
}
