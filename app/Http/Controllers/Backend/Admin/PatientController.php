<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Charts\ControlChart;
use App\Http\Controllers\Controller;
use App\Models\PatientControl;
use App\Repositories\Backend\Admin\PatientRepository;
use App\Http\Requests\Backend\Admin\Patient\StorePatientRequest;
use App\Http\Requests\Backend\Admin\Patient\ManagePatientRequest;
use App\Http\Requests\Backend\Admin\Patient\UpdatePatientRequest;
use Carbon\Carbon;
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

    public function getAge()
    {
        if(request('birthdate'))
        {
            $birthdate = Carbon::createFromFormat('d/m/Y',request('birthdate'));
            $age  = $birthdate->age;
            return response()->json(['age'=>$age],200);
        }
    }

    public function storeControl(ManagePatientRequest $request, Patient $patient)
    {
        try{
            $this->patientRepository->storeControl($request->all(),$patient);
        }catch (\Exception $exception){
            return response()->json(['error'=>$exception->getMessage()],422);
        }
        return response()->json(['mensaje'=>'Control Guardado'],200);
    }

    public function controls(ManagePatientRequest $request,Patient $patient)
    {
        $patient->load('controls');
        $data    = $patient->controls->sortBy('period');

        return Datatables::of($data)
            ->editColumn('period',function ($row){
                return $row->period->format('d/m/Y');
            })
            ->addColumn('actions', function($row){
                return view('backend.admin.patient.includes.datatable-patient-controls-buttons',compact('row'));
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function destroyControl(ManagePatientRequest $request)
    {
        if(request('id'))
        {
            $control = PatientControl::find(request('id'));
            $this->patientRepository->deleteControl($control);
            return response()->json(['mensaje'=>"Control eliminado"],200);
        }
        return App::abort(402);
    }

    public function getControl(ManagePatientRequest $request)
    {
        if(request('id'))
        {
            $control = PatientControl::find(request('id'));
            return response()->json(['control'=>$control,'period' => $control->period->format('m/Y'),],200);
        }
        return App::abort(402);
    }

    public function controlGraphics(ManagePatientRequest $request,Patient $patient)
    {
        $patient->load('controls');
        $controls = $patient->controls->sortBy('period');

        if($controls->isNotEmpty())
        {
            $graphic_data = $this->processControls($controls);
            $graphics     = $this->createControlGraphic($graphic_data);

            return view('backend.admin.patient.partials.control-graphics', compact('graphics'));
        }

        return '';
    }

    private function processControls($controls)
    {
        $graphic_data = [];
        $colors_used  = [];
        foreach ($controls as $i => $control)
        {
            $color = $control->random_color();

            while (in_array($color,$colors_used))
            {
                $color = $control->random_color();
            }

            $colors_used[] = $color;

            $graphic_data['labels'][]   = $control->period->format('d/m/Y');
            $graphic_data['controls'][$i]['pesos'][]    = $control->weight;
            $graphic_data['controls'][$i]['cintura'][]  = $control->waist;
            $graphic_data['controls'][$i]['cadera'][]   = $control->hips;
            $graphic_data['controls'][$i]['kg musculo'][] = $control->muscle_kg;
            $graphic_data['controls'][$i]['kg grasa'][]   = $control->fat_kg;
            $graphic_data['controls'][$i]['% musculo'][]  = $control->muscle_percent;
            $graphic_data['controls'][$i]['% grasa'][]    = $control->fat_percent;
            $graphic_data['controls'][$i]['colors']     = $color;
        }

        return $graphic_data;
    }

    private function createControlGraphic(&$graphic_data)
    {
        $chart_progress_weight = new ControlChart();
        $chart_progress_weight->options(
            [
                'tooltip' => [
                    'show' => true
                ]
            ]
        );

        $chart_progress_weight->labels($graphic_data['labels']);

        foreach ($graphic_data['controls'] as $i => $data_control)
        {

            $chart_progress_weight->dataset('Peso', 'line', $data_control['pesos'])
                ->options(
                    [
                        'borderColor'    => $data_control['colors'],
                        'color'          => $data_control['colors'],
                        'backgroundColor'=> $data_control['colors'],
                        'fill'           => false,
                    ]
                );

            $chart_progress_weight->dataset('Cintura', 'line', $data_control['cintura'])
                ->options(
                    [
                        'borderColor'    => $data_control['colors'],
                        'color'          => $data_control['colors'],
                        'backgroundColor'=> $data_control['colors'],
                        'fill'           => false,
                    ]
                );

            $chart_progress_weight->dataset('Cadera', 'line', $data_control['cadera'])
                ->options(
                    [
                        'borderColor'    => $data_control['colors'],
                        'color'          => $data_control['colors'],
                        'backgroundColor'=> $data_control['colors'],
                        'fill'           => false,
                    ]
                );

            $chart_progress_weight->dataset('Kg Músculo', 'line', $data_control['kg musculo'])
                ->options(
                    [
                        'borderColor'    => $data_control['colors'],
                        'color'          => $data_control['colors'],
                        'backgroundColor'=> $data_control['colors'],
                        'fill'           => false,
                    ]
                );

            $chart_progress_weight->dataset('Kg Grasa', 'line', $data_control['kg grasa'])
                ->options(
                    [
                        'borderColor'    => $data_control['colors'],
                        'color'          => $data_control['colors'],
                        'backgroundColor'=> $data_control['colors'],
                        'fill'           => false,
                    ]
                );

            $chart_progress_weight->dataset('% Músculo', 'line', $data_control['% musculo'])
                ->options(
                    [
                        'borderColor'    => $data_control['colors'],
                        'color'          => $data_control['colors'],
                        'backgroundColor'=> $data_control['colors'],
                        'fill'           => false,
                    ]
                );

            $chart_progress_weight->dataset('% Grasa', 'line', $data_control['% grasa'])
                ->options(
                    [
                        'borderColor'    => $data_control['colors'],
                        'color'          => $data_control['colors'],
                        'backgroundColor'=> $data_control['colors'],
                        'fill'           => false,
                    ]
                );
        }

        return $chart_progress_weight;
    }
}
