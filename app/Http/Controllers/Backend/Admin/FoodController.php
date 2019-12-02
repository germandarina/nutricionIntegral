<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Admin\FoodRepository;
use App\Http\Requests\Backend\Admin\Food\StoreFoodRequest;
use App\Http\Requests\Backend\Admin\Food\ManageFoodRequest;
use App\Http\Requests\Backend\Admin\Food\UpdateFoodRequest;
use JsValidator;
use Session;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Food;

/**
 * Class FoodController.
 */
class FoodController extends Controller
{
    /**
     * @var FoodRepository
     */
    protected $foodRepository;

    /**
     * @param FoodRepository       $foodRepository
     */
    public function __construct(FoodRepository $foodRepository)
    {
        $this->foodRepository = $foodRepository;
    }

    /**
     * @param ManageFoodRequest $request
     *
     * @return mixed
     */
    public function index(ManageFoodRequest $request)
    {
        if ($request->ajax()) {
            $data = $this->foodRepository->orderBy('id')->get();
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    return view('backend.admin.food.includes.datatable-buttons',compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.food.index');
    }

    /**
     * @param ManageFoodRequest $request
     *
     * @return mixed
     */
    public function create(ManageFoodRequest $request)
    {
        $validator = JsValidator::formRequest(StoreFoodRequest::class);
        return view('backend.admin.food.create',compact('validator'));
    }

    /**
     * @param StoreFoodRequest $request
     *
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function store(StoreFoodRequest $request)
    {
        $this->foodRepository->create($request->all());
        Session::flash('success','Alimento Creado');
        return redirect()->route('admin.food.index');
    }

    /**
     * @param ManageFoodRequest $request
     * @param Food              $food
     *
     * @return mixed
     */
    public function edit(ManageFoodRequest $request, Food $food)
    {
        if (!auth()->user()->isAdmin()) {
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('admin.food.index');
        }
        $validator = JsValidator::formRequest(UpdateFoodRequest::class);

        return view('backend.admin.food.edit',compact('food','validator'));
    }

    /**
     * @param UpdateFoodRequest $request
     * @param Food              $food
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function update(UpdateFoodRequest $request, Food $food)
    {
        $this->foodRepository->update($request->all(), $food);
        Session::flash('success','Alimento Actualizado');
        return redirect()->route('admin.food.index');
    }

    /**
     * @param ManageFoodRequest $request
     * @param Food              $food
     *
     * @return mixed
     *@throws \Exception
     */
    public function destroy(ManageFoodRequest $request, Food $food)
    {
        if (!auth()->user()->isAdmin()) {
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('admin.food.index');
        }

        $this->foodRepository->deleteById($food->id);
        Session::flash('success','Empelado Eliminado');
        return redirect()->route('admin.food.index');
    }

    public function getDeleted(ManageFoodRequest $request){
        if ($request->ajax()) {
            $data = $this->foodRepository->getDeletedPaginated(25, 'id', 'asc');
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    return view('backend.admin.food.includes.datatable-buttons',compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.food.deleted');
    }

    /**
     * @param ManageFoodRequest $request
     * @param integer              $id
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function restore(ManageFoodRequest $request, $id)
    {
        $food = Food::onlyTrashed()->find($id);
        $this->foodRepository->restore($food);
        Session::flash('success','Alimento restaurado');
        return redirect()->route('admin.food.index');
    }
}
