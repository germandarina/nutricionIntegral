<?php

namespace App\Repositories\Backend\Admin;

use App\Models\SocialWork;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Session;

/**
 * Class SocialWorkRepository.
 */
class SocialWorkRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return SocialWork::class;
    }

    /**
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return SocialWork
     */
    public function create(array $data) : SocialWork
    {
        // Make sure it doesn't already exist
        if ($this->socialWorkExists($data['name'])) {
            Session::flash('error','Ya existe un obra social con el nombre '.$data['name']);
            throw new GeneralException('Ya existe un obra social con el nombre '.$data['name']);
        }
        return DB::transaction(function () use ($data) {
            $social_work = parent::create($data);

            if ($social_work) {
                return $social_work;
            }
            Session::flash('error','Error al crear obra social. Intente nuevamente');
            throw new GeneralException('Error al crear obra social. Intente nuevamente');
        });
    }

    /**
     * @param SocialWork  $social_work
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(array $data, SocialWork $social_work)
    {
        if (!auth()->user()->isAdmin()) {
            Session::flash('error','No tiene permiso para realizar esta acción');
            throw new GeneralException('No tiene permiso para realizar esta acción');
        }

        // If the name is changing make sure it doesn't already exist
        if ($social_work->name !== strtolower($data['name'])) {
            if ($this->social_workExists($data['name'])) {
                Session::flash('error','Ya existe un obra social con el nombre '.$data['name']);
                throw new GeneralException('Ya existe un obra social con el nombre '.$data['name']);
            }
        }

        return DB::transaction(function () use ($social_work, $data) {
            if ($social_work->update($data)) {
                return $social_work;
            }
            Session::flash('error','Error al actualizar obra social. Intente nuevamente');
            throw new GeneralException('Error al actualizar obra social. Intente nuevamente');
        });
    }

    /**
     * @param $name
     *
     * @return bool
     */
    protected function socialWorkExists($name) : bool
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
     * @param SocialWork $social_work
     *
     * @throws GeneralException
     * @return SocialWork
     */
    public function restore(SocialWork $social_work) : SocialWork
    {
        if ($social_work->deleted_at === null) {
            Session::flash('error','La obra social no esta eliminada');
            throw new GeneralException('La obra social no esta eliminada');
        }
        if ($social_work->restore()) {
            return $social_work;
        }
        Session::flash('error','Error al restaurar obra social. Intente nuevamente');
        throw new GeneralException('Error al restaurar obra social. Intente nuevamente');
    }
}
