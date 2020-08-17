<?php

namespace App\Repositories\Backend\Admin;

use App\Models\BasicInformation ;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Session;

/**
 * Class BasicInformation Repository.
 */
class BasicInformationRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return BasicInformation ::class;
    }

    /**
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return BasicInformation
     */
    public function create(array $data) : BasicInformation
    {
        return DB::transaction(function () use ($data) {
            $data['default_register'] = 0;
            $basic_information = parent::create($data);

            if ($basic_information) {
                return $basic_information;
            }
            throw new GeneralException('Error al crear informacion basica. Intente nuevamente');
        });
    }

    /**
     * @param BasicInformation  $basic_information
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(array $data, BasicInformation $basic_information)
    {
        if (!auth()->user()->isAdmin()) {
            throw new GeneralException('No tiene permiso para realizar esta acción');
        }

        return DB::transaction(function () use ($basic_information, $data) {
            if ($basic_information->update($data)) {
                return $basic_information;
            }
            throw new GeneralException('Error al actualizar informacion basica. Intente nuevamente');
        });
    }
}
