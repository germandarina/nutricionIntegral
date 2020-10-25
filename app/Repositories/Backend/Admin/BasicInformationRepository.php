<?php

namespace App\Repositories\Backend\Admin;

use App\Models\BasicInformation ;
use App\Models\Phone;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

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

    public function storePhone(array $data, BasicInformation $basic_information)
    {
        if (!auth()->user()->isAdmin()) {
            throw new GeneralException('No tiene permiso para realizar esta acción');
        }

        return DB::transaction(function () use ($basic_information, $data) {
            $phone = new Phone();
            $phone->fill($data);
            $phone->basic_information_id = $basic_information->id;
            if(!$phone->save()){
                throw new GeneralException('Error al actualizar informacion basica. Intente nuevamente');
            }
        });
    }

    public function deletePhone()
    {

    }
}
