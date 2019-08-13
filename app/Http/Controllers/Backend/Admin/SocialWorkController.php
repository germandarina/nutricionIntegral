<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Admin\SocialWorkRepository;
use App\Http\Requests\Backend\Admin\SocialWork\StoreSocialWorkRequest;
use App\Http\Requests\Backend\Admin\SocialWork\ManageSocialWorkRequest;
use App\Http\Requests\Backend\Admin\SocialWork\UpdateSocialWorkRequest;
use JsValidator;
use Session;
use Yajra\DataTables\Facades\DataTables;
use App\Models\SocialWork;

/**
 * Class SocialWorkController.
 */
class SocialWorkController extends Controller
{
    /**
     * @var SocialWorkRepository
     */
    protected $social_workRepository;

    /**
     * @param SocialWorkRepository       $social_workRepository
     */
    public function __construct(SocialWorkRepository $social_workRepository)
    {
        $this->social_workRepository = $social_workRepository;
    }

    /**
     * @param ManageSocialWorkRequest $request
     *
     * @return mixed
     */
    public function index(ManageSocialWorkRequest $request)
    {
        if ($request->ajax()) {
            $data = $this->social_workRepository->orderBy('id')->get();
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    return view('backend.admin.social_work.includes.datatable-buttons',compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.social_work.index');
    }

    /**
     * @param ManageSocialWorkRequest $request
     *
     * @return mixed
     */
    public function create(ManageSocialWorkRequest $request)
    {
        $validator = JsValidator::formRequest(StoreSocialWorkRequest::class);
        return view('backend.admin.social_work.create',compact('validator'));
    }

    /**
     * @param StoreSocialWorkRequest $request
     *
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function store(StoreSocialWorkRequest $request)
    {
        $this->social_workRepository->create($request->all());
        Session::flash('success','Obra Social Creada');
        return redirect()->route('admin.social_work.index');
    }

    /**
     * @param ManageSocialWorkRequest $request
     * @param SocialWork              $social_work
     *
     * @return mixed
     */
    public function edit(ManageSocialWorkRequest $request, SocialWork $social_work)
    {
        if (!auth()->user()->isAdmin()) {
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('admin.social_work.index');
        }
        $validator = JsValidator::formRequest(UpdateSocialWorkRequest::class);

        return view('backend.admin.social_work.edit',compact('social_work','validator'));
    }

    /**
     * @param UpdateSocialWorkRequest $request
     * @param SocialWork              $social_work
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function update(UpdateSocialWorkRequest $request, SocialWork $social_work)
    {
        $this->social_workRepository->update($request->all(), $social_work);
        Session::flash('success','Obra Social Actualizada');
        return redirect()->route('admin.social_work.index');
    }

    /**
     * @param ManageSocialWorkRequest $request
     * @param SocialWork              $social_work
     *
     * @return mixed
     *@throws \Exception
     */
    public function destroy(ManageSocialWorkRequest $request, SocialWork $social_work)
    {
        if (!auth()->user()->isAdmin()) {
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('admin.social_work.index');
        }

        $this->social_workRepository->deleteById($social_work->id);
        Session::flash('success','Empelado Eliminado');
        return redirect()->route('admin.social_work.index');
    }

    public function getDeleted(ManageSocialWorkRequest $request){
        if ($request->ajax()) {
            $data = $this->social_workRepository->getDeletedPaginated(25, 'id', 'asc');
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    return view('backend.admin.social_work.includes.datatable-buttons',compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.social_work.deleted');
    }

    /**
     * @param ManageSocialWorkRequest $request
     * @param integer              $id
     *
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function restore(ManageSocialWorkRequest $request, $id)
    {
        $social_work = SocialWork::onlyTrashed()->find($id);
        $this->social_workRepository->restore($social_work);
        Session::flash('success','Obra Social restaurado');
        return redirect()->route('admin.social_work.index');
    }
}
