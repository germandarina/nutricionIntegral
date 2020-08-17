<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Admin\BasicInformationRepository;
use App\Http\Requests\Backend\Admin\BasicInformation\StoreBasicInformationRequest;
use App\Http\Requests\Backend\Admin\BasicInformation\ManageBasicInformationRequest;
use JsValidator;
use Session;
use Yajra\DataTables\Facades\DataTables;
use App\Models\BasicInformation;

/**
 * Class BasicInformationController.
 */
class BasicInformationController extends Controller
{
    /**
     * @var BasicInformationRepository
     */
    protected $basicInformation;

    /**
     * @param BasicInformationRepository       $basicInformation
     */
    public function __construct(BasicInformationRepository $basicInformation)
    {
        $this->basicInformation = $basicInformation;
    }

    /**
     * @param ManageBasicInformationRequest $request
     *
     * @return mixed
     */
    public function index(ManageBasicInformationRequest $request)
    {
        if ($request->ajax()) {
            $data = $this->basicInformation->orderBy('id')->get();
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    if(!$row->default_register){
                        return view('backend.admin.basic-information.includes.datatable-buttons',compact('row'));
                    }
                    return "";
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.basic-information.index');
    }

    /**
     * @param ManageBasicInformationRequest $request
     *
     * @return mixed
     */
    public function create(ManageBasicInformationRequest $request)
    {
        $validator = JsValidator::formRequest(StoreBasicInformationRequest::class);
        return view('backend.admin.basic-information.create',compact('validator'));
    }

    /**
     * @param StoreBasicInformationRequest $request
     *
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function store(StoreBasicInformationRequest $request)
    {
        try{
            $this->basicInformation->create($request->all());
        }catch (\Exception $exception){
            Session::flash('error',$exception->getMessage());
            return redirect()->route('admin.basic-information.create')->withInput($request->all());
        }
        Session::flash('success','Clasificacion Creada');
        return redirect()->route('admin.basic-information.index');
    }

    /**
     * @param ManageBasicInformationRequest $request
     * @param BasicInformation              $basic_information
     *
     * @return mixed
     */
    public function edit(ManageBasicInformationRequest $request, BasicInformation $basic_information)
    {
        if (!auth()->user()->isAdmin() || $basic_information->default_register) {
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('admin.basic-information.index');
        }

        $validator = JsValidator::formRequest(StoreBasicInformationRequest::class);

        return view('backend.admin.basic-information.edit',compact('basic-information','validator'));
    }

    /**
     * @param StoreBasicInformationRequest $request
     * @param BasicInformation              $basic_information
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function update(StoreBasicInformationRequest $request, BasicInformation $basic_information)
    {
        if (!auth()->user()->isAdmin() || $basic_information->default_register) {
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('admin.basic-information.index');
        }

        try{
            $this->basicInformation->update($request->all(), $basic_information);
        }catch (\Exception $exception){
            Session::flash('error',$exception->getMessage());
            return redirect()->route('admin.basic-information.edit',compact('basic-information'))->withInput($request->all());
        }
        Session::flash('success','Clasificacion Actualizada');
        return redirect()->route('admin.basic-information.index');
    }
}
