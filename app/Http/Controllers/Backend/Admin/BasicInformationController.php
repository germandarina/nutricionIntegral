<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Admin\BasicInformation\UpdateBasicInformationRequest;
use App\Models\Phone;
use App\Repositories\Backend\Admin\BasicInformationRepository;
use App\Http\Requests\Backend\Admin\BasicInformation\StoreBasicInformationRequest;
use App\Http\Requests\Backend\Admin\BasicInformation\ManageBasicInformationRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
        $basic_information =  BasicInformation::first();

        if ($request->ajax()) {
            $data = $this->basicInformation->with('phones')->orderBy('id')->get();
            return Datatables::of($data)
                ->addColumn('phones',function ($row){
                    return $row->phones_front;
                })
                ->addColumn('actions', function($row){
                    return view('backend.admin.basic-information.includes.datatable-buttons',compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.basic-information.index',compact('basic_information'));
    }

    /**
     * @param ManageBasicInformationRequest $request
     *
     * @return mixed
     */
    public function create(ManageBasicInformationRequest $request)
    {
        $basic_information =  BasicInformation::first();
        if(!is_null($basic_information)){
            Session::flash('error','Acceso Denegado');
            return redirect()->route('admin.basic-information.index');
        }

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

            if (!$request->hasFile('image'))
                throw new \Exception("Debe cargar una imagen");

            $image   = request()->file('image');
            $formato = explode('/',$image->getClientMimeType());
            request()->file('image')->storeAs('',"pdf_client.{$formato[1]}",'client');
            $request['path_image'] = "pdf_client.{$formato[1]}";

            $basic_information = $this->basicInformation->create($request->all());

        }catch (\Exception $exception){
            Session::flash('error',$exception->getMessage());
            return redirect()->route('admin.basic-information.create')->withInput($request->all());
        }

        Session::flash('success','Información Personal Creada');
        return redirect()->route('admin.basic-information.edit',compact('basic_information'));
    }

    /**
     * @param ManageBasicInformationRequest $request
     * @param BasicInformation              $basic_information
     *
     * @return mixed
     */
    public function edit(ManageBasicInformationRequest $request, BasicInformation $basic_information)
    {
        if (!auth()->user()->isAdmin()) {
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('admin.basic-information.index');
        }

        $validator = JsValidator::formRequest(UpdateBasicInformationRequest::class);

        return view('backend.admin.basic-information.edit',compact('basic_information','validator'));
    }

    /**
     * @param StoreBasicInformationRequest $request
     * @param BasicInformation             $basic_information
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function update(UpdateBasicInformationRequest $request, BasicInformation $basic_information)
    {
        if (!auth()->user()->isAdmin()) {
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('admin.basic-information.index');
        }

        try{
            if($request->hasFile('image'))
            {
                $image   = request()->file('image');
                $formato = explode('/',$image->getClientMimeType());
                request()->file('image')->storeAs('',"pdf_client.{$formato[1]}",'client');
                $request['path_image'] = "pdf_client.{$formato[1]}";
            }

            $this->basicInformation->update($request->all(), $basic_information);
        }catch (\Exception $exception){
            Session::flash('error',$exception->getMessage());
            return redirect()->route('admin.basic-information.edit',compact('basic-information'))->withInput($request->all());
        }
        Session::flash('success','Información Personal Actualizada');
        return redirect()->route('admin.basic-information.index');
    }

    public function getPhones(BasicInformation $basic_information)
    {
        $data = $basic_information->phones();
        return Datatables::of($data)
            ->addColumn('actions', function($row){
                return view('backend.admin.basic-information.includes.datatable-buttons-phones',compact('row'));
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function storePhone(BasicInformation $basic_information)
    {
        if(request('phone') && request('code_area'))
        {
            try{
                $this->basicInformation->storePhone(request()->all(), $basic_information);
                return response()->json(['mensaje' => "Teléfono Agregado"], 200);
            }catch (\Exception $exception){
                return response()->json(['error' => $exception->getMessage()], 422);
            }
        }
    }

    public function deletePhone($id)
    {
        try{
            $phone = Phone::find($id);
            $phone->forceDelete();
            return response()->json(['mensaje' => "Teléfono Eliminado"], 200);
        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage()], 422);
        }
    }
}
