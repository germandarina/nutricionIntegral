<?php

namespace App\Repositories\Backend\Auth;

use App\Models\Auth\Role;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Events\Backend\Auth\Role\RoleCreated;
use App\Events\Backend\Auth\Role\RoleUpdated;
use Session;

/**
 * Class RoleRepository.
 */
class RoleRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return Role
     */
    public function create(array $data) : Role
    {
        // Make sure it doesn't already exist
        if ($this->roleExists($data['name'])) {
            Session::flash('error','Ya existe un rol con el nombre'.$data['name']);
            throw new GeneralException('A role already exists with the name '.e($data['name']));
        }

        if (! isset($data['permissions']) || ! \count($data['permissions'])) {
            $data['permissions'] = [];
        }

        //See if the role must contain a permission as per config
        if (config('access.roles.role_must_contain_permission') && \count($data['permissions']) === 0) {
            Session::flash('error',__('exceptions.backend.access.roles.needs_permission'));
            throw new GeneralException(__('exceptions.backend.access.roles.needs_permission'));
        }

        return DB::transaction(function () use ($data) {
            $role = parent::create(['name' => strtolower($data['name'])]);

            if ($role) {
                $role->givePermissionTo($data['permissions']);

                event(new RoleCreated($role));

                return $role;
            }
            Session::flash('error',trans('exceptions.backend.access.roles.create_error'));
            throw new GeneralException(trans('exceptions.backend.access.roles.create_error'));
        });
    }

    /**
     * @param Role  $role
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(Role $role, array $data)
    {
        if ($role->isAdmin()) {
            Session::flash('error','No puede editar un rol administrador');
            throw new GeneralException('You can not edit the administrator role.');
        }

        // If the name is changing make sure it doesn't already exist
        if ($role->name !== strtolower($data['name'])) {
            if ($this->roleExists($data['name'])) {
                Session::flash('error','Ya existe un rol con el nombre'.$data['name']);
                throw new GeneralException('A role already exists with the name '.$data['name']);
            }
        }

        if (! isset($data['permissions']) || ! \count($data['permissions'])) {
            $data['permissions'] = [];
        }

        //See if the role must contain a permission as per config
        if (config('access.roles.role_must_contain_permission') && \count($data['permissions']) === 0) {
            Session::flash('error',trans('exceptions.backend.access.roles.needs_permission'));
            throw new GeneralException(__('exceptions.backend.access.roles.needs_permission'));
        }

        return DB::transaction(function () use ($role, $data) {
            $role->name = strtolower($data['name']);
            if($role->save()){
                $role->syncPermissions($data['permissions']);

                event(new RoleUpdated($role));

                return $role;
            }
//            if ($role->update([
//                'name' => strtolower($data['name']),
//            ])) {
//                $role->syncPermissions($data['permissions']);
//
//                event(new RoleUpdated($role));
//
//                return $role;
//            }
            Session::flash('error',trans('exceptions.backend.access.roles.update_error'));
            throw new GeneralException(trans('exceptions.backend.access.roles.update_error'));
        });
    }

    /**
     * @param $name
     *
     * @return bool
     */
    protected function roleExists($name) : bool
    {
        return $this->model
            ->where('name', strtolower($name))
            ->count() > 0;
    }

    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc')
    {
        return $this->model
//            ->with('permissions')
            ->onlyTrashed()
            ->orderBy($orderBy, $sort);
        //->paginate($paged);
    }


    /**
     * @param Role $role
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return Role
     */
    public function forceDelete(Role $role) : Role
    {
        if ($role->deleted_at === null) {
            Session::flash('error',__('exceptions.backend.access.roles.cant_restore'));
            throw new GeneralException(__('exceptions.backend.access.users.delete_first'));
        }

        return DB::transaction(function () use ($role) {
            if ($role->forceDelete()) {
                return $role;
            }
            Session::flash('error',__('exceptions.backend.access.roles.cant_restore'));
            throw new GeneralException(__('exceptions.backend.access.roles.delete_error'));
        });
    }

    /**
     * @param Role $role
     *
     * @throws GeneralException
     * @return Role
     */
    public function restore(Role $role) : Role
    {
        if ($role->deleted_at === null) {
            Session::flash('error',__('exceptions.backend.access.roles.cant_restore'));
            throw new GeneralException(__('exceptions.backend.access.users.cant_restore'));
        }
        if ($role->restore()) {
            return $role;
        }
        Session::flash('error',__('exceptions.backend.access.roles.restore_error'));
        throw new GeneralException(__('exceptions.backend.access.roles.restore_error'));
    }
}
