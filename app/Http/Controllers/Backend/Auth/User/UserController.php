<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Models\Auth\User;
use App\Http\Controllers\Controller;
use App\Events\Backend\Auth\User\UserDeleted;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Repositories\Backend\Auth\UserRepository;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Http\Requests\Backend\Auth\User\StoreUserRequest;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Http\Requests\Backend\Auth\User\UpdateUserRequest;
use Session;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class UserController.
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageUserRequest $request)
    {
        if ($request->ajax()) {
            $data = $this->userRepository->getActivePaginated(25, 'id', 'asc');
            return Datatables::of($data)
                ->editColumn('confirmed_label', function($row){
                    return $row->confirmed_label;
                })
                ->editColumn('roles_label', function($row){
                    return $row->roles_label;
                })
                ->editColumn('permissions_label', function($row){
                    return $row->permissions_label;
                })
                ->editColumn('social_buttons', function($row){
                    return $row->social_buttons;
                })
                ->editColumn('last_updated', function($row){
                    return $row->updated_at->diffForHumans();
                })
                ->addColumn('actions', function($row){
                    return $row->action_buttons;
                })
                ->rawColumns(['actions','social_buttons','confirmed_label','roles_label','permissions_label'])
                ->make(true);
        }

        return view('backend.access.auth.user.index');//->withUsers($this->userRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function create(ManageUserRequest $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        if(!auth()->user()->isAdmin() || !(auth()->user()->email == 'benjaminkaramazov1991@gmail.com' || auth()->user()->email == 'admin@com'))
        {
            Session::flash('error','No tiene permiso para realizar esta acción');
            return redirect()->route('access.auth.user.index');
        }

        return view('backend.access.auth.user.create')
            ->withRoles($roleRepository->with('permissions')->get(['id', 'name']))
            ->withPermissions($permissionRepository->get(['id', 'name']));
    }

    /**
     * @param StoreUserRequest $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(StoreUserRequest $request)
    {

        if(!auth()->user()->isAdmin() || !(auth()->user()->email == 'benjaminkaramazov1991@gmail.com' || auth()->user()->email == 'admin@com'))
        {
            Session::flash('error','No tiene permiso para realizar esta acción');
            return redirect()->route('access.auth.user.index');
        }

        $this->userRepository->create($request->only(
            'first_name',
            'last_name',
            'email',
            'password',
            'active',
            'confirmed',
            'confirmation_email',
            'roles',
            'permissions'
        ));
        Session::flash('success',__('alerts.backend.users.created'));

        return redirect()->route('access.auth.user.index');//->withFlashSuccess(__('alerts.backend.users.created'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @return mixed
     */
    public function show(ManageUserRequest $request, User $user)
    {
        return view('backend.access.auth.user.show')
            ->withUser($user);
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param User                 $user
     *
     * @return mixed
     */
    public function edit(ManageUserRequest $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository, User $user)
    {
        return view('backend.access.auth.user.edit')
            ->withUser($user)
            ->withRoles($roleRepository->get())
            ->withUserRoles($user->roles->pluck('name')->all())
            ->withPermissions($permissionRepository->get(['id', 'name']))
            ->withUserPermissions($user->permissions->pluck('name')->all());
    }

    /**
     * @param UpdateUserRequest $request
     * @param User              $user
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userRepository->update($user, $request->only(
            'first_name',
            'last_name',
            'email',
            'roles',
            'permissions'
        ));

        Session::flash('success',__('alerts.backend.users.updated'));
        return redirect()->route('access.auth.user.index');//->withFlashSuccess(__('alerts.backend.users.updated'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy(ManageUserRequest $request, User $user)
    {
        $this->userRepository->deleteById($user->id);

        event(new UserDeleted($user));
        Session::flash('success',__('alerts.backend.users.deleted'));
        return redirect()->route('access.auth.user.deleted');//->withFlashSuccess(__('alerts.backend.users.deleted'));
    }
}
