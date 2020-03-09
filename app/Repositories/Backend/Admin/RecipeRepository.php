<?php

namespace App\Repositories\Backend\Admin;

use App\Models\Recipe;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Session;

/**
 * Class RecipeRepository.
 */
class RecipeRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Recipe::class;
    }

    /**
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return Recipe
     */
    public function create(array $data) : Recipe
    {
        // Make sure it doesn't already exist
        if ($this->patientExists($data['document'])) {
            Session::flash('error','Ya existe un paciente con el documento '.$data['document']);
            throw new GeneralException('Ya existe un paciente con el documento '.$data['document']);
        }
        return DB::transaction(function () use ($data) {
            $patient = parent::create($data);

            if ($patient) {
                return $patient;
            }
            Session::flash('error','Error al crear paciente. Intente nuevamente');
            throw new GeneralException('Error al crear paciente. Intente nuevamente');
        });
    }

    /**
     * @param Recipe  $patient
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(array $data, Recipe $patient)
    {
        if (!auth()->user()->isAdmin()) {
            Session::flash('error','No tiene permiso para realizar esta acción');
            throw new GeneralException('No tiene permiso para realizar esta acción');
        }

        // If the name is changing make sure it doesn't already exist
        if ($patient->document !== strtolower($data['document'])) {
            if ($this->patientExists($data['document'])) {
                Session::flash('error','Ya existe un paciente con el documento '.$data['document']);
                throw new GeneralException('Ya existe un paciente con el documento '.$data['document']);
            }
        }

        return DB::transaction(function () use ($patient, $data) {
            if (!$patient->update($data)) {
                Session::flash('error','Error al actualizar paciente. Intente nuevamente');
                throw new GeneralException('Error al actualizar paciente. Intente nuevamente');
            }
            $patient->foodGroups()->sync($data['food_group_id']);
            $patient->foods()->sync($data['food_id']);
            return $patient;
        });
    }

    /**
     * @param $name
     *
     * @return bool
     */
    protected function patientExists($document) : bool
    {
        return $this->model
            ->where('document', strtolower($document))
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
     * @param Recipe $patient
     *
     * @throws GeneralException
     * @return Recipe
     */
    public function restore(Recipe $patient) : Recipe
    {
        if ($patient->deleted_at === null) {
            Session::flash('error','El paciente no esta eliminado');
            throw new GeneralException('El paciente no esta eliminado');
        }
        if ($patient->restore()) {
            return $patient;
        }
        Session::flash('error','Error al restaurar paciente. Intente nuevamente');
        throw new GeneralException('Error al restaurar paciente. Intente nuevamente');
    }
}
