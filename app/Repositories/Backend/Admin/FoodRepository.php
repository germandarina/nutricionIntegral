<?php

namespace App\Repositories\Backend\Admin;

use App\Models\Food;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Session;

/**
 * Class FoodRepository.
 */
class FoodRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Food::class;
    }

    /**
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return Food
     */
    public function create(array $data) : Food
    {
        // Make sure it doesn't already exist
        if ($this->foodExists($data['name'])) {
            throw new GeneralException('Ya existe un alimento con el nombre '.$data['name']);
        }
        return DB::transaction(function () use ($data) {
            foreach ($data as $indice => $valor){
                if($valor == '0,000' || is_null($valor)){
                    $data[$indice] = 0;
                }
            }
//            $data['name'] = $this->model->_sanear_string($data['name']);
            $food = parent::create($data);

            if ($food) {
                return $food;
            }
            throw new GeneralException('Error al crear alimento. Intente nuevamente');
        });
    }

    /**
     * @param Food  $food
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(array $data, Food $food)
    {
        if (!auth()->user()->isAdmin()) {
            throw new GeneralException('No tiene permiso para realizar esta acción');
        }

        return DB::transaction(function () use ($food, $data) {
            foreach ($data as $indice => $valor){
                if($valor == '0,000' || is_null($valor)){
                    $data[$indice] = 0;
                }
            }
//            $data['name'] = $this->model->_sanear_string($data['name']);
            if ($food->update($data)) {
                return $food;
            }
            throw new GeneralException('Error al actualizar alimento. Intente nuevamente');
        });
    }

    /**
     * @param $name
     *
     * @return bool
     */
    protected function foodExists($name) : bool
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
     * @param Food $food
     *
     * @throws GeneralException
     * @return Food
     */
    public function restore(Food $food) : Food
    {
        if (is_null($food->deleted_at)) {
            throw new GeneralException('El alimento no esta eliminado');
        }
        if ($food->restore()) {
            return $food;
        }
        throw new GeneralException('Error al restaurar alimento. Intente nuevamente');
    }
}
