<?php

namespace App\Http\Controllers\Backend\Admin;

use App;
use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use App\Models\PlanDetail;
use App\Models\PlanDetailDay;
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
        Session::flash('success','Plan Creado');
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
        Session::flash('success','Plan Actualizado');
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
        Session::flash('success','Plan restaurado');
        return redirect()->route('admin.plan.index');
    }

    public function addRecipes(ManagePlanRequest $request, Plan $plan){
        $paciente = $plan->patient;
        $foods = $paciente->foods->pluck('id');
        $food_groups = $paciente->foodGroups->pluck('id');
        $classifications = $paciente->classifications->pluck('id');
        $array_dias = [];
        for ($i=1;$i<=$plan->days;$i++){
            $array_dias[$i] = "Día {$i}";
        }
        return view('backend.admin.plan.recipes',compact('plan','paciente','foods','food_groups','classifications','array_dias'));
    }

    public function getRecipesForPlan(){
        $foods              = request('foods');
        $food_groups        = request('food_groups');
        $classifications    = request('classifications');
        $recipe_types       = request('recipe_types');
        $recipe_name        = request('recipe_name');
        $min_calorias       = request('min_calorias');
        $max_calorias       = request('max_calorias');
        $query_recipes      = Recipe::with(['ingredients.food','classifications','recipeType'])
                                        ->has('ingredients')
                                        ->where('edit',false);
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
        $cantidad = count($recipes);
        $html = (string) view('backend.admin.plan.partials.list-recipes',compact('recipes'));
        return compact('html','cantidad');
    }

    public function getModalRecipe(){
        if(request('recipe_id')){
            $recipe = Recipe::find(request('recipe_id'));
            $recipe->load('ingredients.food');
            return view('backend.admin.plan.partials.modal-recipe',compact('recipe'));
        }
        return App::abort(422);
    }

    public function addRecipeToPlan(){
        if(request('recipe_id') && request('plan_id')){
            $recipe = $this->planRepository->addRecipe(request()->all());
            $html = "";
            if(request('edit') == 1){
                $html = (string) view('backend.admin.plan.partials.modal-recipe-edit',compact('recipe'));
            }
            return response()->json(['mensaje'=>'Receta agregada','html'=>$html],200);
        }
        return App::abort(422);
    }

    public function getRecipes(Plan $plan){
        $data =  PlanDetail::with(['recipe.recipeType','recipe.classifications'])->where('plan_id',$plan->id)->get();
        return Datatables::of($data)
            ->editColumn('classifications',function ($row){
                $string_classifications = "";
                foreach ($row->recipe->classifications as $classification){
                    $string_classifications .= $classification->name.' / ';
                }
                return trim($string_classifications,' / ');
            })
            ->editColumn('recipeType',function ($row){
                return $row->recipe->recipeType->name;
            })
            ->addColumn('actions', function($row){
                return view('backend.admin.plan.includes.datatable-plan-detail-buttons',compact('row'));
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function deleteDetail(){
        if(request('id')){
            $detail = PlanDetail::find(request('id'));
            $detail->delete();
            return response()->json(['mensaje'=>'Receta eliminada'],200);
        }
        return App::abort(422);
    }

    public function addPlanDetailDay(){
        if(request('recipes')){
            $this->planRepository->addPlanDetailDay(request()->all());
            return response()->json(['mensaje'=>'Recetas agregadas por día'],200);
        }
        return App::abort(422);
    }

    public function getRecipesByDay(Plan $plan){
        $dia = request('day');
        $data =  PlanDetail::with(['recipe.recipeType','recipe.classifications'])
                            ->with(['planDetailsDays'=>function($query_with)use($dia){
                                $query_with->where('day',$dia);
                            }])
                            ->whereHas('planDetailsDays',function ($query) use($dia){
                                $query->where('day',$dia);
                            })
                            ->where('plan_id',$plan->id)
                            ->get();
        return Datatables::of($data)
            ->editColumn('classifications',function ($row){
                $string_classifications = "";
                foreach ($row->recipe->classifications as $classification){
                    $string_classifications .= $classification->name.' / ';
                }
                return trim($string_classifications,' / ');
            })
            ->editColumn('recipeType',function ($row){
                return $row->recipe->recipeType->name;
            })
            ->addColumn('quantity_day',function ($row){
               return $row->planDetailsDays->count();
            })
            ->addColumn('actions', function($row) use ($dia){
                return view('backend.admin.plan.includes.datatable-plan-detail-by-day-buttons',compact('row','dia'));
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function deleteDetailByDay(){
        if(request('id')){
            $details = PlanDetailDay::where('plan_detail_id',request('id'))
                                    ->where('day',request('day'))
                                    ->get();
            foreach ($details as $detail){
                $detail->delete();
            }
            $dia = request('day');
            return response()->json(['mensaje'=>"Receta/s eliminada del día $dia"],200);
        }
        return App::abort(422);
    }

    public function getTotalRecipesByDay(Plan $plan){
        if(request('day')){
            $day = request('day');
            $total = [];
            $this->getValuesForDay($plan->id,$day,$total);
            return view('backend.admin.plan.partials.table-total-plan-by-day',
                        compact('total','plan','day'));

        }
        return App::abort(422);
    }

    public function getTotalCompletoPlanPorDia(){
        if(request('plan_id') && request('day')){
            $day        = request('day');
            $plan_id    = request('plan_id');
            $total = [];
            $this->getValuesForDay($plan_id,$day,$total);
            return view('backend.admin.plan.partials.total-completo-plan-por-dia',compact('total'));
        }
    }

    private function getValuesForDay($plan_id,$day,&$total){
        $plan_details =  PlanDetail::with('recipe')
            ->with(['planDetailsDays'=>function($query_with)use($day){
                $query_with->where('day',$day);
            }])
            ->whereHas('planDetailsDays',function ($query) use($day){
                $query->where('day',$day);
            })
            ->where('plan_id',$plan_id)
            ->get();

        $total['total_energia_kcal']            = 0;
        $total['total_proteina']                = 0;
        $total['total_grasa_total']             = 0;
        $total['total_carbohidratos_totales']   = 0;
        $total['total_colesterol']              = 0;
        $total['total_agua']                    = 0;
        $total['total_cenizas']                 = 0;
        $total['total_sodio']                   = 0;
        $total['total_potasio']                 = 0;
        $total['total_calcio']                  = 0;
        $total['total_fosforo']                 = 0;
        $total['total_hierro']                  = 0;
        $total['total_zinc']                    = 0;
        $total['total_tiamina']                 = 0;
        $total['total_rivoflavina']             = 0;
        $total['total_niacina']                 = 0;
        $total['total_vitamina_c']              = 0;
        $total['total_carbohidratos_disponibles']    = 0;
        $total['total_ac_grasos_saturados']          = 0;
        $total['total_ac_grasos_monoinsaturados']    = 0;
        $total['total_ac_grasos_poliinsaturados']    = 0;
        $total['total_fibra']                        = 0;
        $total['total_calorias']                     = 0;

        foreach ($plan_details as $detail){
            $quantity_by_day =  $detail->planDetailsDays->count();
            $recipe = $detail->recipe;

            $total['total_energia_kcal']            += $recipe->total_energia_kcal * $quantity_by_day;
            $total['total_proteina']                += $recipe->total_proteina * $quantity_by_day;
            $total['total_grasa_total']             += $recipe->total_grasa_total * $quantity_by_day;
            $total['total_carbohidratos_totales']   += $recipe->total_carbohidratos_totales * $quantity_by_day;
            $total['total_colesterol']              += $recipe->total_colesterol * $quantity_by_day;
            $total['total_agua']                    += $recipe->total_agua * $quantity_by_day;
            $total['total_cenizas']                 += $recipe->total_cenizas * $quantity_by_day;
            $total['total_sodio']                   += $recipe->total_sodio * $quantity_by_day;
            $total['total_potasio']                 += $recipe->total_potasio * $quantity_by_day;
            $total['total_calcio']                  += $recipe->total_calcio * $quantity_by_day;
            $total['total_fosforo']                 += $recipe->total_fosforo * $quantity_by_day;
            $total['total_hierro']                  += $recipe->total_hierro * $quantity_by_day;
            $total['total_zinc']                    += $recipe->total_zinc * $quantity_by_day;
            $total['total_tiamina']                 += $recipe->total_tiamina * $quantity_by_day;
            $total['total_rivoflavina']             += $recipe->total_rivoflavina * $quantity_by_day;
            $total['total_niacina']                 += $recipe->total_niacina * $quantity_by_day;
            $total['total_vitamina_c']              += $recipe->tota_vitamina_c * $quantity_by_day;
            $total['total_carbohidratos_disponibles']  += $recipe->total_carbohidratos_disponibles * $quantity_by_day;
            $total['total_ac_grasos_saturados']        += $recipe->total_ac_grasos_saturados * $quantity_by_day;
            $total['total_ac_grasos_monoinsaturados']  += $recipe->total_ac_grasos_monoinsaturados * $quantity_by_day;
            $total['total_ac_grasos_poliinsaturados']  += $recipe->total_ac_grasos_poliinsaturados * $quantity_by_day;
            $total['total_fibra']                      += $recipe->total_fibra * $quantity_by_day;
            $total['total_calorias']                   += $recipe->total_calorias * $quantity_by_day;
        }
    }
}
