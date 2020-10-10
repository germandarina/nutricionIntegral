<?php

namespace App\Repositories\Backend\Admin;

use App\Models\Observation;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

/**
 * Class ObservationRepository.
 */
class ObservationRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Observation::class;
    }

    /**
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return Observation
     */
    public function create(array $data) : Observation
    {

        return DB::transaction(function () use ($data) {
            $observation = parent::create($data);

            if ($observation) {
                return $observation;
            }
            throw new GeneralException('Error al crear observación. Intente nuevamente');
        });
    }

    /**
     * @param Observation  $observation
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(array $data, Observation $observation)
    {
        if (!auth()->user()->isAdmin()) {
            throw new GeneralException('No tiene permiso para realizar esta acción');
        }

        return DB::transaction(function () use ($observation, $data) {
            if ($observation->update($data)) {
                return $observation;
            }
            throw new GeneralException('Error al actualizar observación. Intente nuevamente');
        });
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
     * @param Observation $observation
     *
     * @throws GeneralException
     * @return Observation
     */
    public function restore(Observation $observation) : Observation
    {
        if ($observation->deleted_at === null) {
            throw new GeneralException('La observación no esta eliminado');
        }
        if ($observation->restore()) {
            return $observation;
        }
        throw new GeneralException('Error al restaurar observación. Intente nuevamente');
    }
}
