<?php

namespace App\Http\Controllers\Backend\Auth\Role;

use App\Models\Auth\Role;
use App\Http\Controllers\Controller;
use App\Events\Backend\Auth\Role\RoleDeleted;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Http\Requests\Backend\Auth\Role\StoreRoleRequest;
use App\Http\Requests\Backend\Auth\Role\ManageRoleRequest;
use App\Http\Requests\Backend\Auth\Role\UpdateRoleRequest;
use Session;
use Yajra\DataTables\Facades\DataTables;
/**
 * Class RoleController.
 */
class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    /**
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @param ManageRoleRequest $request
     *
     * @return mixed
     */
    public function index(ManageRoleRequest $request)
    {
        if ($request->ajax()) {
            $data = $this->roleRepository->with('users', 'permissions')->orderBy('id')->get();
            return Datatables::of($data)
                ->addColumn('permissions', function($row){
                    if ($row->id == 1) {
                        return 'Todos';
                    } else {
                        if ($row->permissions->count()) {
                            $stringRoles = "";
                            foreach ($row->permissions as $permission) {
                                $stringRoles .= $permission->name . ' / ';
                            }
                            return trim($stringRoles, ' / ');
                        }else{
                            return 'Ninguno';
                        }
                    }
                })
                ->editColumn('numbers_of_users', function($row) {
                    return $row->users->count();
                })
                ->addColumn('actions', function($row){
                    return $row->action_buttons;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.access.auth.role.index');
    }

    /**
     * @param ManageRoleRequest $request
     *
     * @return mixed
     */
    public function create(ManageRoleRequest $request)
    {
        return view('backend.access.auth.role.create')
            ->withPermissions($this->permissionRepository->get());
    }

    /**
     * @param StoreRoleRequest $request
     *
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function store(StoreRoleRequest $request)
    {
        $this->roleRepository->create($request->only('name', 'associated-permissions', 'permissions', 'sort'));
        Session::flash('success',__('alerts.backend.roles.created'));
        return redirect()->route('access.auth.role.index');
    }

    /**
     * @param ManageRoleRequest $request
     * @param Role              $role
     *
     * @return mixed
     */
    public function edit(ManageRoleRequest $request, Role $role)
    {
        if ($role->isAdmin()) {
            return redirect()->route('access.auth.role.index')->withFlashDanger('You can not edit the administrator role.');
        }

        return view('backend.access.auth.role.edit')
            ->withRole($role)
            ->withRolePermissions($role->permissions->pluck('name')->all())
            ->withPermissions($this->permissionRepository->get());
    }

    /**
     * @param UpdateRoleRequest $request
     * @param Role              $role
     *
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->roleRepository->update($role, $request->only('name', 'permissions'));
        Session::flash('success',__('alerts.backend.roles.updated'));
        return redirect()->route('access.auth.role.index');
    }

    /**
     * @param ManageRoleRequest $request
     * @param Role              $role
     *
     * @return mixed
     *@throws \Exception
     */
    public function destroy(ManageRoleRequest $request, Role $role)
    {
        if ($role->isAdmin()) {
            return redirect()->route('access.auth.role.index')->withFlashDanger(__('exceptions.backend.access.roles.cant_delete_admin'));
        }

        $this->roleRepository->deleteById($role->id);

        event(new RoleDeleted($role));
        Session::flash('success',__('alerts.backend.roles.deleted'));
        return redirect()->route('access.auth.role.index');
    }

    public function getDeleted(ManageRoleRequest $request)
    {
        if ($request->ajax()) {
            $data = $this->roleRepository->getDeletedPaginated(25, 'id', 'asc');
            return Datatables::of($data)
                ->addColumn('permissions', function($row){
                    if ($row->id == 1) {
                        return 'Todos';
                    } else {
                        if ($row->permissions->count()) {
                            $stringRoles = "";
                            foreach ($row->permissions as $permission) {
                                $stringRoles .= $permission->name . ' / ';
                            }
                            return trim($stringRoles, ' / ');
                        }else{
                            return 'Ninguno';
                        }
                    }
                })
                ->editColumn('numbers_of_users', function($row) {
                    return $row->users->count();
                })
                ->addColumn('actions', function($row){
                    return $row->action_buttons;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.access.auth.role.deleted');
    }

    /**
     * @param ManageRoleRequest $request
     * @param Role              $deletedRole
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function delete(ManageRoleRequest $request, Role $deletedRole)
    {
        $this->roleRepository->forceDelete($deletedRole);
        Session::flash('success',__('alerts.backend.users.deleted_permanently'));
        return redirect()->route('access.auth.role.deleted');//->withFlashSuccess(__('alerts.backend.users.deleted_permanently'));
    }

    /**
     * @param ManageRoleRequest $request
     * @param Role              $deletedRole
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function restore(ManageRoleRequest $request, Role $deletedRole)
    {
        $this->roleRepository->restore($deletedRole);
        Session::flash('success',__('alerts.backend.users.restored'));
        return redirect()->route('access.auth.role.index');//->withFlashSuccess(__('alerts.backend.users.restored'));
    }
}
