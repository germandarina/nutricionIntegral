<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Admin\ClassificationRepository;
use App\Http\Requests\Backend\Admin\Classification\StoreClassificationRequest;
use App\Http\Requests\Backend\Admin\Classification\ManageClassificationRequest;
use App\Http\Requests\Backend\Admin\Classification\UpdateClassificationRequest;
use JsValidator;
use Session;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Classification;

/**
 * Class ClassificationController.
 */
class ClassificationController extends Controller
{
    /**
     * @var ClassificationRepository
     */
    protected $classificationRepository;

    /**
     * @param ClassificationRepository       $classificationRepository
     */
    public function __construct(ClassificationRepository $classificationRepository)
    {
        $this->classificationRepository = $classificationRepository;
    }

    /**
     * @param ManageClassificationRequest $request
     *
     * @return mixed
     */
    public function index(ManageClassificationRequest $request)
    {
        if ($request->ajax()) {
            $data = $this->classificationRepository->orderBy('id')->get();
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    if(!$row->default_register){
                        return view('backend.admin.classification.includes.datatable-buttons',compact('row'));
                    }
                    return "";
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.classification.index');
    }

    /**
     * @param ManageClassificationRequest $request
     *
     * @return mixed
     */
    public function create(ManageClassificationRequest $request)
    {
        $validator = JsValidator::formRequest(StoreClassificationRequest::class);
        return view('backend.admin.classification.create',compact('validator'));
    }

    /**
     * @param StoreClassificationRequest $request
     *
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function store(StoreClassificationRequest $request)
    {
        try{
            $this->classificationRepository->create($request->all());
        }catch (\Exception $exception){
            Session::flash('error',$exception->getMessage());
            return redirect()->route('admin.classification.create')->withInput($request->all());
        }
        Session::flash('success','Clasificacion Creada');
        return redirect()->route('admin.classification.index');
    }

    /**
     * @param ManageClassificationRequest $request
     * @param Classification              $classification
     *
     * @return mixed
     */
    public function edit(ManageClassificationRequest $request, Classification $classification)
    {
        if (!auth()->user()->isAdmin() || $classification->default_register) {
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('admin.classification.index');
        }

        $validator = JsValidator::formRequest(UpdateClassificationRequest::class);

        return view('backend.admin.classification.edit',compact('classification','validator'));
    }

    /**
     * @param UpdateClassificationRequest $request
     * @param Classification              $classification
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function update(UpdateClassificationRequest $request, Classification $classification)
    {
        if (!auth()->user()->isAdmin() || $classification->default_register) {
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('admin.classification.index');
        }

        try{
            $this->classificationRepository->update($request->all(), $classification);
        }catch (\Exception $exception){
            Session::flash('error',$exception->getMessage());
            return redirect()->route('admin.classification.edit',compact('classification'))->withInput($request->all());
        }
        Session::flash('success','Clasificacion Actualizada');
        return redirect()->route('admin.classification.index');
    }

    /**
     * @param ManageClassificationRequest $request
     * @param Classification              $classification
     *
     * @return mixed
     *@throws \Exception
     */
    public function destroy(ManageClassificationRequest $request, Classification $classification)
    {
        if (!auth()->user()->isAdmin() || $classification->default_register) {
            return response()->json(['mensaje'=>"No tiene permiso para eliminar"],422);
        }

        $classification->load('patients','recipes');

        if($classification->recipes->isNotEmpty()){
            return response()->json(['mensaje'=>"Una receta tiene asignada esta clasificación"],422);
        }

        if($classification->patients->isNotEmpty()){
            return response()->json(['mensaje'=>"Un paciente tiene asignado esta clasificación"],422);
        }

        $this->classificationRepository->deleteById($classification->id);
        return response()->json(['mensaje'=>"Clasificación eliminada"],200);
    }

    public function getDeleted(ManageClassificationRequest $request){
        if ($request->ajax()) {
            $data = $this->classificationRepository->getDeletedPaginated(25, 'id', 'asc');
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    return view('backend.admin.classification.includes.datatable-buttons',compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.classification.deleted');
    }

    /**
     * @param ManageClassificationRequest $request
     * @param integer              $id
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function restore(ManageClassificationRequest $request, $id)
    {
        $classification = Classification::onlyTrashed()->find($id);
        try{
            $this->classificationRepository->restore($classification);
        }catch (\Exception $exception){
            return response()->json(['error'=>$exception->getMessage()],422);
        }
        return response()->json(['mensaje'=>"Clasificación restaurada"],200);
    }
}
