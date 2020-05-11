<?php

namespace App\Http\Controllers\Backend\Admin;

use App;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Admin\PlanRepository;
use App\Http\Requests\Backend\Admin\Plan\StorePlanRequest;
use App\Http\Requests\Backend\Admin\Plan\ManagePlanRequest;
use App\Http\Requests\Backend\Admin\Plan\UpdatePlanRequest;
use JsValidator;
use Session;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Plan;
use App\Models\Recipe;
use Illuminate\Support\Facades\DB;

/**
 * Class PlanController.
 */
class PlanController extends Controller
{
    /**
     * @var PlanRepository
     */
    protected $planRepository;

    /**
     * @param PlanRepository       $planRepository
     */
    public function __construct(PlanRepository $planRepository)
    {
        $this->planRepository = $planRepository;
    }

    /**
     * @param ManagePlanRequest $request
     *
     * @return mixed
     */
    public function index(ManagePlanRequest $request)
    {
        if ($request->ajax()) {
            $data = $this->planRepository->with('patient')->orderBy('id')->get();
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    return view('backend.admin.plan.includes.datatable-buttons',compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.plan.index');
    }

    /**
     * @param ManagePlanRequest $request
     *
     * @return mixed
     */
    public function create(ManagePlanRequest $request)
    {
        $validator = JsValidator::formRequest(StorePlanRequest::class);
        return view('backend.admin.plan.create',compact('validator'));
    }

    /**
     * @param StorePlanRequest $request
     *
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function store(StorePlanRequest $request)
    {
        $this->planRepository->create($request->all());
        Session::flash('success','Alimento Creado');
        return redirect()->route('admin.plan.index');
    }

    /**
     * @param ManagePlanRequest $request
     * @param Plan              $plan
     *
     * @return mixed
     */
    public function edit(ManagePlanRequest $request, Plan $plan)
    {
        if (!auth()->user()->isAdmin()) {
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('admin.plan.index');
        }
        $validator = JsValidator::formRequest(UpdatePlanRequest::class);

        return view('backend.admin.plan.edit',compact('plan','validator'));
    }

    /**
     * @param UpdatePlanRequest $request
     * @param Plan              $plan
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
        public function update(UpdatePlanRequest $request, Plan $plan)
    {
        $this->planRepository->update($request->all(), $plan);
        Session::flash('success','Alimento Actualizado');
        return redirect()->route('admin.plan.index')->status(200);
    }

    /**
     * @param ManagePlanRequest $request
     * @param Plan              $plan
     *
     * @return mixed
     *@throws \Exception
     */
    public function destroy(ManagePlanRequest $request, Plan $plan)
    {
        if (!auth()->user()->isAdmin()) {
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('admin.plan.index');
        }

        $this->planRepository->deleteById($plan->id);
        Session::flash('success','Plan Eliminado');
        return redirect()->route('admin.plan.index');
    }

    public function getDeleted(ManagePlanRequest $request){
        if ($request->ajax()) {
            $data = $this->planRepository->getDeletedPaginated(25, 'id', 'asc');
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    return view('backend.admin.plan.includes.datatable-buttons',compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.plan.deleted');
    }

    /**
     * @param ManagePlanRequest $request
     * @param integer              $id
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function restore(ManagePlanRequest $request, $id)
    {
        $plan = Plan::onlyTrashed()->find($id);
        $this->planRepository->restore($plan);
        Session::flash('success','Alimento restaurado');
        return redirect()->route('admin.plan.index');
    }

    public function addRecipes(ManagePlanRequest $request, Plan $plan){
        $paciente = $plan->patient;
        $foods = $paciente->foods->pluck('id');
        $food_groups = $paciente->foodGroups->pluck('id');
        $classifications = $paciente->classifications->pluck('id');
        return view('backend.admin.plan.recipes',compact('plan','paciente','foods','food_groups','classifications'));
    }

    public function getRecipesForPlan(){
        $foods              = request('foods');
        $food_groups        = request('food_groups');
        $classifications    = request('classifications');
        $recipe_types       = request('recipe_types');
        $recipe_name        = request('recipe_name');
        $min_calorias       = request('min_calorias');
        $max_calorias       = request('max_calorias');
        $query_recipes      = Recipe::with(['ingredients.food','classifications','recipeType']);
        if($recipe_name){
            $query_recipes->fullText($recipe_name);
        }
        if($min_calorias){
            $query_recipes->where('total_calorias','>=',$min_calorias);
        }
        if($max_calorias){
            $query_recipes->where('total_calorias','<=',$max_calorias);
        }
        if($foods || $food_groups){
            $query_recipes->whereHas('ingredients.food',function ($query)use($foods,$food_groups){
                if($foods){
                    $query->whereNotIn('id',$foods);
                }
                if($food_groups){
                    $query->whereNotIn('food_group_id',$food_groups);
                }
            });
        }
        if($classifications){
            $query_recipes->whereHas('classifications',function ($query)use($classifications){
                $query->whereIn('id',$classifications);
            });
        }
        if($recipe_types){
            $query_recipes->whereHas('recipeType',function ($query)use($recipe_types){
                $query->whereIn('id',$recipe_types);
            });
        }
        $recipes = $query_recipes->get();
        return view('backend.admin.plan.partials.list-recipes',compact('recipes'));
    }
}
