<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Models\Auth\User;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Auth\UserRepository;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use Session;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class UserStatusController.
 */
class UserStatusController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function getDeactivated(ManageUserRequest $request)
    {
        if ($request->ajax()) {
            $data = $this->userRepository->getInactivePaginated(25, 'id', 'asc');
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

        return view('backend.access.auth.user.deactivated');
//
//
//
//
//        return view('backend.auth.user.deactivated')
//            ->withUsers($this->userRepository->getInactivePaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ManageUserRequest $request)
    {
        if ($request->ajax()) {
            $data = $this->userRepository->getDeletedPaginated(25, 'id', 'asc');
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

        return view('backend.access.auth.user.deleted');
//
//
//
//
//
//
//        return view('backend.auth.user.deleted')
//            ->withUsers($this->userRepository->getDeletedPaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     * @param                   $status
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function mark(ManageUserRequest $request, User $user, $status)
    {
        $this->userRepository->mark($user, (int) $status);

        return redirect()->route(
            (int) $status === 1 ?
            'access.auth.user.index' :
            'access.auth.user.deactivated'
        )->withFlashSuccess(__('alerts.backend.users.updated'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $deletedUser
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function delete(ManageUserRequest $request, User $deletedUser)
    {
        $this->userRepository->forceDelete($deletedUser);
        Session::flash('success',__('alerts.backend.users.deleted_permanently'));
        return redirect()->route('access.auth.user.deleted');//->withFlashSuccess(__('alerts.backend.users.deleted_permanently'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $deletedUser
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function restore(ManageUserRequest $request, User $deletedUser)
    {
        $this->userRepository->restore($deletedUser);
        Session::flash('success',__('alerts.backend.users.restored'));
        return redirect()->route('access.auth.user.index');//->withFlashSuccess(__('alerts.backend.users.restored'));
    }
}
