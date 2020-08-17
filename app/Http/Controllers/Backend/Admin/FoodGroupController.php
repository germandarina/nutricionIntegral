<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Admin\FoodGroupRepository;
use App\Http\Requests\Backend\Admin\FoodGroup\StoreFoodGroupRequest;
use App\Http\Requests\Backend\Admin\FoodGroup\ManageFoodGroupRequest;
use App\Http\Requests\Backend\Admin\FoodGroup\UpdateFoodGroupRequest;
use JsValidator;
use Session;
use Yajra\DataTables\Facades\DataTables;
use App\Models\FoodGroup;

/**
 * Class FoodGroupController.
 */
class FoodGroupController extends Controller
{
    /**
     * @var FoodGroupRepository
     */
    protected $foodGroupRepository;

    /**
     * @param FoodGroupRepository       $foodGroupRepository
     */
    public function __construct(FoodGroupRepository $foodGroupRepository)
    {
        $this->foodGroupRepository = $foodGroupRepository;
    }

    /**
     * @param ManageFoodGroupRequest $request
     *
     * @return mixed
     */
    public function index(ManageFoodGroupRequest $request)
    {
        if ($request->ajax()) {
            $data = $this->foodGroupRepository->orderBy('id')->get();
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    return view('backend.admin.food-group.includes.datatable-buttons',compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.food-group.index');
    }

    /**
     * @param ManageFoodGroupRequest $request
     *
     * @return mixed
     */
    public function create(ManageFoodGroupRequest $request)
    {
        $validator = JsValidator::formRequest(StoreFoodGroupRequest::class);
        return view('backend.admin.food-group.create',compact('validator'));
    }

    /**
     * @param StoreFoodGroupRequest $request
     *
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function store(StoreFoodGroupRequest $request)
    {
        $this->foodGroupRepository->create($request->all());
        Session::flash('success','Grupo de Alimentos Creado');
        return redirect()->route('admin.food-group.index');
    }

    /**
     * @param ManageFoodGroupRequest $request
     * @param FoodGroup              $food_group
     *
     * @return mixed
     */
    public function edit(ManageFoodGroupRequest $request, FoodGroup $food_group)
    {
        if (!auth()->user()->isAdmin()) {
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('admin.food-group.index');
        }
        $validator = JsValidator::formRequest(UpdateFoodGroupRequest::class);

        return view('backend.admin.food-group.edit',compact('food_group','validator'));
    }

    /**
     * @param UpdateFoodGroupRequest $request
     * @param FoodGroup              $food_group
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function update(UpdateFoodGroupRequest $request, FoodGroup $food_group)
    {
        $this->foodGroupRepository->update($request->all(), $food_group);
        Session::flash('success','Grupo de Alimentos Actualizado');
        return redirect()->route('admin.food-group.index');
    }

    /**
     * @param ManageFoodGroupRequest $request
     * @param FoodGroup              $food_group
     *
     * @return mixed
     *@throws \Exception
     */
    public function destroy(ManageFoodGroupRequest $request, FoodGroup $food_group)
    {
        if (!auth()->user()->isAdmin()) {
            return response()->json(['mensaje'=>"No tiene permiso para eliminar"],422);
        }

        $food_group->load('foods');

        if($food_group->foods->isNotEmpty()){
            return response()->json(['mensaje'=>"Un alimento ya tiene asignado este grupo"],422);
        }

        $this->foodGroupRepository->deleteById($food_group->id);
        return response()->json(['mensaje'=>"Grupo de alimento eliminado"],200);
    }

    public function getDeleted(ManageFoodGroupRequest $request){
        if ($request->ajax()) {
            $data = $this->foodGroupRepository->getDeletedPaginated(25, 'id', 'asc');
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    return view('backend.admin.food-group.includes.datatable-buttons',compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.food-group.deleted');
    }

    /**
     * @param ManageFoodGroupRequest $request
     * @param integer              $id
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function restore(ManageFoodGroupRequest $request, $id)
    {
        $food_group = FoodGroup::onlyTrashed()->find($id);
        $this->foodGroupRepository->restore($food_group);
        return response()->json(['mensaje'=>"Grupo de alimento restaturado"],200);
    }
}
