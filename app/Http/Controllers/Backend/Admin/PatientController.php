<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Admin\PatientRepository;
use App\Http\Requests\Backend\Admin\Patient\StorePatientRequest;
use App\Http\Requests\Backend\Admin\Patient\ManagePatientRequest;
use App\Http\Requests\Backend\Admin\Patient\UpdatePatientRequest;
use JsValidator;
use Session;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Patient;

/**
 * Class PatientController.
 */
class PatientController extends Controller
{
    /**
     * @var PatientRepository
     */
    protected $patientRepository;

    /**
     * @param PatientRepository       $patientRepository
     */
    public function __construct(PatientRepository $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }

    /**
     * @param ManagePatientRequest $request
     *
     * @return mixed
     */
    public function index(ManagePatientRequest $request)
    {
        if ($request->ajax()) {
            $data = $this->patientRepository->orderBy('id')->get();
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    return view('backend.admin.patient.includes.datatable-buttons',compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.patient.index');
    }

    /**
     * @param ManagePatientRequest $request
     *
     * @return mixed
     */
    public function create(ManagePatientRequest $request)
    {
        $validator = JsValidator::formRequest(StorePatientRequest::class);
        return view('backend.admin.patient.create',compact('validator'));
    }

    /**
     * @param StorePatientRequest $request
     *
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function store(StorePatientRequest $request)
    {
        try{
            $patient = $this->patientRepository->create($request->all());
        }catch (\Exception $exception){
            Session::flash('error', $exception->getMessage());
            return redirect()->route('admin.patient.create')->withInput($request->all());
        }

        Session::flash('success','Paciente Creado');
        return redirect()->route('admin.patient.edit',compact('patient'));
    }

    /**
     * @param ManagePatientRequest $request
     * @param Patient              $patient
     *
     * @return mixed
     */
    public function edit(ManagePatientRequest $request, Patient $patient)
    {
        if (!auth()->user()->isAdmin()) {
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('admin.patient.index');
        }
        $validator = JsValidator::formRequest(UpdatePatientRequest::class);
        $foods = $patient->foods->pluck('id');
        $food_groups = $patient->foodGroups->pluck('id');
        $classifications = $patient->classifications->pluck('id');
        return view('backend.admin.patient.edit',compact('patient','validator','foods','food_groups','classifications'));
    }

    /**
     * @param UpdatePatientRequest $request
     * @param Patient              $patient
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        try{
            $this->patientRepository->update($request->all(), $patient);
        }catch (\Exception $exception){
            Session::flash('error', $exception->getMessage());
            return redirect()->route('admin.patient.edit',compact('patient'))->withInput($request->all());
        }
        Session::flash('success','Paciente Actualizado');
        return redirect()->route('admin.patient.index');
    }

    /**
     * @param ManagePatientRequest $request
     * @param Patient              $patient
     *
     * @return mixed
     *@throws \Exception
     */
    public function destroy(ManagePatientRequest $request, Patient $patient)
    {
        if (!auth()->user()->isAdmin()) {
            return response()->json(['error'=>"No tiene permiso para eliminar"],422);
        }

        $patient->load('plans');
        if($patient->plans->isNotEmpty()){
            return response()->json(['error'=>"El paciente ya posee planes asignados"],422);
        }
        $this->patientRepository->deleteById($patient->id);
        return response()->json(['mensaje'=>"Paciente eliminado"],200);
    }

    public function getDeleted(ManagePatientRequest $request){
        if ($request->ajax()) {
            $data = $this->patientRepository->getDeletedPaginated(25, 'id', 'asc');
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    return view('backend.admin.patient.includes.datatable-buttons',compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.patient.deleted');
    }

    /**
     * @param ManagePatientRequest $request
     * @param integer              $id
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function restore(ManagePatientRequest $request, $id)
    {
        $patient = Patient::onlyTrashed()->find($id);
        try{
            $this->patientRepository->restore($patient);
        }catch (\Exception $exception){
            return response()->json(['error'=>$exception->getMessage()],422);
        }
        return response()->json(['mensaje'=>"Paciente restaurado"],200);
    }

    public function searchPatients(){
        $buscar     = trim(request('q'));
        $query      = Patient::fullText($buscar);
        $patients   = $query->limit(20)->get(["id","full_name","document"])->toArray();
        $patients   = array_map(function ($item){
                          return ['id' => $item['id'], 'text' => $item['full_name']];
                      }, $patients);
        return \Response::json($patients);
    }
}
