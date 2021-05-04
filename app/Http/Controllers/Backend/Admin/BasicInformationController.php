<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Admin\BasicInformation\UpdateBasicInformationRequest;
use App\Models\Phone;
use App\Models\Recommendation;
use App\Repositories\Backend\Admin\BasicInformationRepository;
use App\Http\Requests\Backend\Admin\BasicInformation\StoreBasicInformationRequest;
use App\Http\Requests\Backend\Admin\BasicInformation\ManageBasicInformationRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use JsValidator;
use PDF;
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
    protected $basicInformationRepository;

    /**
     * @param BasicInformationRepository       $basicInformationRepository
     */
    public function __construct(BasicInformationRepository $basicInformationRepository)
    {
        $this->basicInformationRepository = $basicInformationRepository;
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
            $data = $this->basicInformationRepository->with('phones')->orderBy('id')->get();
            return Datatables::of($data)
                ->addColumn('phones',function ($row){
                    return $row->phones_front;
                })
                ->addColumn('actions', function($row){
                    return view('backend.config.basic-information.includes.datatable-buttons',compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.config.basic-information.index',compact('basic_information'));
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
            return redirect()->route('config.basic-information.index');
        }

        $validator = JsValidator::formRequest(StoreBasicInformationRequest::class);
        return view('backend.config.basic-information.create',compact('validator'));
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

            $request['path_image'] = null;


            if ($request->hasFile('image'))
            {
                $image              = request()->file('image');
                $name_without_space = str_replace(' ','',$request['company_name']);
                $formato            = explode('/',$image->getClientMimeType());
                $full_name_file     = "pdf_client_{$name_without_space}.{$formato[1]}";
                $full_name_file     = BasicInformation::_sanear_string($full_name_file);

                request()->file('image')->storeAs('',$full_name_file,'client');

                $request['path_image'] = $full_name_file;
            }

            $basic_information = $this->basicInformationRepository->create($request->all());

        }catch (\Exception $exception){
            Session::flash('error',$exception->getMessage());
            return redirect()->route('config.basic-information.create')->withInput($request->all());
        }

        Session::flash('success','Información Personal Creada');
        return redirect()->route('config.basic-information.edit',compact('basic_information'));
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
            return redirect()->route('config.basic-information.index');
        }

        $validator = JsValidator::formRequest(UpdateBasicInformationRequest::class);

        return view('backend.config.basic-information.edit',compact('basic_information','validator'));
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
            return redirect()->route('config.basic-information.index');
        }

        try{
            if($request->hasFile('image'))
            {
                if(!is_null($basic_information->path_image) && Storage::exists(public_path("img/backend/client/{$basic_information->path_image}")))
                    unlink(public_path("img/backend/client/{$basic_information->path_image}"));

                $image              = request()->file('image');
                $name_without_space = str_replace(' ','',$request['company_name']);
                $formato            = explode('/',$image->getClientMimeType());
                $full_name_file     = "pdf_client_{$name_without_space}.{$formato[1]}";
                $full_name_file     = BasicInformation::_sanear_string($full_name_file);

                request()->file('image')->storeAs('',$full_name_file,'client');

                $request['path_image'] = $full_name_file;
            }

            $this->basicInformationRepository->update($request->all(), $basic_information);
        }catch (\Exception $exception){
            Session::flash('error',$exception->getMessage());
            return redirect()->route('config.basic-information.edit',compact('basic_information'))->withInput($request->all());
        }

        Session::flash('success','Información Personal Actualizada');
        return redirect()->route('config.basic-information.index');
    }

    public function getPhones(BasicInformation $basic_information)
    {
        $basic_information->load('phones');
        $data = $basic_information->phones;
        return Datatables::of($data)
            ->addColumn('actions', function($row){
                return view('backend.config.basic-information.includes.datatable-buttons-phones',compact('row'));
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function storePhone(BasicInformation $basic_information)
    {
        if(request('phone') && request('code_area'))
        {
            try{
                $this->basicInformationRepository->storePhone(request()->all(), $basic_information);
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

    public function getRecommendations(BasicInformation $basic_information)
    {
        $basic_information->load('recommendations');
        $data = $basic_information->recommendations;
        return Datatables::of($data)
            ->editColumn('type',function ($row){
                return Recommendation::$types[$row->type];
            })
            ->editColumn('recommendation',function ($row){
                if($row->type == Recommendation::type_img){
                    return view('backend.config.basic-information.includes.show-recommendation-img',compact('row'));
                }
                return $row->recommendation;
            })
            ->addColumn('actions', function($row){
                return view('backend.config.basic-information.includes.datatable-buttons-recommendations',compact('row'));
            })
            ->rawColumns(['actions','recommendation'])
            ->make(true);
    }


    public function storeRecommendation(BasicInformation $basic_information)
    {
        if(request()->hasFile('recommendation_img'))
        {
            $image   = request()->file('recommendation_img');
            $formato = explode('/',$image->getClientMimeType());

            if($formato[1] != 'jpg' && $formato[1] != 'jpeg' && $formato[1] != 'png')
                return response()->json(['error' => 'Debe seleccionar una imagen jpg,jpeg o png'], 422);

            $now     = Carbon::now()->format('YmdHis');
            request()->file('recommendation_img')->storeAs('',"recommendations_{$now}.{$formato[1]}",'client');
            $request['recommendation'] = "recommendations_{$now}.{$formato[1]}";
            $request['type']           = Recommendation::type_img;
        }
        else
        {
           $request['recommendation'] = request('recommendation');
           $request['type']           = Recommendation::type_text;
        }

        try{
            $this->basicInformationRepository->storeRecommendation($request, $basic_information);
            return response()->json(['mensaje' => "Recomendación Agregada"], 200);
        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage()], 422);
        }
    }

    public function deleteRecommendation($id)
    {
        try{
            $recommendation = Recommendation::find($id);
            if($recommendation->type == Recommendation::type_img)
                unlink(public_path("img/backend/client/{$recommendation->recommendation}"));

            $recommendation->forceDelete();
            return response()->json(['mensaje' => "Recomendación Eliminada"], 200);
        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage()], 422);
        }
    }

    public function downloadRecommendation(Recommendation  $recommendation)
    {
        return \Response::download(public_path("img/backend/client/{$recommendation->recommendation}"));
    }

    public function storeColors(BasicInformation $basic_information)
    {
        try{
            $this->basicInformationRepository->storeColors(request()->all(), $basic_information);
            return response()->json(['mensaje' => "Colores Guardados"], 200);
        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage()], 422);
        }
    }

    public function downloadPlanExample(BasicInformation $basic_information)
    {
        $pdf = PDF::loadView('backend.config.basic-information.pdf_example',compact('basic_information'));
        return $pdf->download("plan_ejemplo.pdf");
    }
}
