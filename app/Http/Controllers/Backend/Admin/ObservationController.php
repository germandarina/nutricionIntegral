<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Admin\ObservationRepository;
use App\Http\Requests\Backend\Admin\Observation\StoreObservationRequest;
use App\Http\Requests\Backend\Admin\Observation\ManageObservationRequest;
use App\Http\Requests\Backend\Admin\Observation\UpdateObservationRequest;
use JsValidator;
use Session;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Observation;

/**
 * Class ObservationController.
 */
class ObservationController extends Controller
{
    /**
     * @var ObservationRepository
     */
    protected $observationRepository;

    /**
     * @param ObservationRepository       $observationRepository
     */
    public function __construct(ObservationRepository $observationRepository)
    {
        $this->observationRepository = $observationRepository;
    }

    /**
     * @param ManageObservationRequest $request
     *
     * @return mixed
     */
    public function index(ManageObservationRequest $request)
    {
        if ($request->ajax()) {
            $data = $this->observationRepository->orderBy('id')->get();
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                   return view('backend.config.observation.includes.datatable-buttons',compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.config.observation.index');
    }

    /**
     * @param ManageObservationRequest $request
     *
     * @return mixed
     */
    public function create(ManageObservationRequest $request)
    {
        $validator = JsValidator::formRequest(StoreObservationRequest::class);
        return view('backend.config.observation.create',compact('validator'));
    }

    /**
     * @param StoreObservationRequest $request
     *
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function store(StoreObservationRequest $request)
    {
        try{
            $this->observationRepository->create($request->all());
        }catch (\Exception $exception){
            Session::flash('error',$exception->getMessage());
            return redirect()->route('config.observation.create')->withInput($request->all());
        }
        Session::flash('success','Observación Creada');
        return redirect()->route('config.observation.index');
    }

    /**
     * @param ManageObservationRequest $request
     * @param Observation              $observation
     *
     * @return mixed
     */
    public function edit(ManageObservationRequest $request, Observation $observation)
    {
        if (!auth()->user()->isAdmin() || $observation->default_register) {
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('config.observation.index');
        }

        $validator = JsValidator::formRequest(UpdateObservationRequest::class);

        return view('backend.config.observation.edit',compact('observation','validator'));
    }

    /**
     * @param UpdateObservationRequest $request
     * @param Observation              $observation
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function update(UpdateObservationRequest $request, Observation $observation)
    {
        if (!auth()->user()->isAdmin() || $observation->default_register) {
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('config.observation.index');
        }

        try{
            $this->observationRepository->update($request->all(), $observation);
        }catch (\Exception $exception){
            Session::flash('error',$exception->getMessage());
            return redirect()->route('config.observation.edit',compact('observation'))->withInput($request->all());
        }
        Session::flash('success','Observación Actualizada');
        return redirect()->route('config.observation.index');
    }

    /**
     * @param ManageObservationRequest $request
     * @param Observation              $observation
     *
     * @return mixed
     *@throws \Exception
     */
    public function destroy(ManageObservationRequest $request, Observation $observation)
    {
        if (!auth()->user()->isAdmin()) {
            return response()->json(['error'=>"No tiene permiso para eliminar"],422);
        }

        $observation->load('recipes');

        if($observation->recipes->isNotEmpty()){
            return response()->json(['error'=>"Una receta tiene asignada esta observación"],422);
        }

        $this->observationRepository->deleteById($observation->id);
        return response()->json(['mensaje'=>"Observación eliminada"],200);
    }

    public function getDeleted(ManageObservationRequest $request){
        if ($request->ajax()) {
            $data = $this->observationRepository->getDeletedPaginated(25, 'id', 'asc');
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    return view('backend.config.observation.includes.datatable-buttons',compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.config.observation.deleted');
    }

    /**
     * @param ManageObservationRequest $request
     * @param integer              $id
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function restore(ManageObservationRequest $request, $id)
    {
        $observation = Observation::onlyTrashed()->find($id);
        try{
            $this->observationRepository->restore($observation);
        }catch (\Exception $exception){
            return response()->json(['error'=>$exception->getMessage()],422);
        }
        return response()->json(['mensaje'=>"Observación restaurada"],200);
    }
}
