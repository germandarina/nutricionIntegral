<?php

namespace App\Http\Controllers\Backend\Admin;

use App;
use App\Http\Controllers\Controller;
use App\Models\BasicInformation;
use App\Models\Observation;
use App\Models\PlanDetail;
use App\Models\PlanEnergySpending;
use App\Repositories\Backend\Admin\PlanRepository;
use App\Http\Requests\Backend\Admin\Plan\StorePlanRequest;
use App\Http\Requests\Backend\Admin\Plan\ManagePlanRequest;
use App\Http\Requests\Backend\Admin\Plan\UpdatePlanRequest;
use JsValidator;
use PDF;
use Session;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Plan;
use App\Models\Recipe;

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
            $data = $this->planRepository->with('patient')
                         ->orderBy('id','desc')
                         ->get();

            return Datatables::of($data)
                ->editColumn('status',function ($row){
                    return $row->status;
                })
                ->editColumn('name',function ($row){
                    return "{$row->name} - Días: {$row->days}";
                })
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
        try{
           $plan = $this->planRepository->create($request->all());
        }catch (\Exception $exception)
        {
            Session::flash('error', $exception->getMessage());
            return redirect()->route('admin.plan.create')->withInput($request->all());
        }
        Session::flash('success','Plan Creado');
        return redirect()->route('admin.plan.edit',compact('plan'));
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
        try{
            $this->planRepository->update($request->all(), $plan);
        }catch (\Exception $exception){
            Session::flash('error', $exception->getMessage());
            return redirect()->route('admin.plan.edit',compact('plan'))->withInput($request->all());
        }
        Session::flash('success','Plan Actualizado');
        return redirect()->route('admin.plan.index');
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
            return response()->json(['error'=>"No tiene permiso para eliminar"],422);
        }

        $this->planRepository->deleteById($plan->id);

        return response()->json(['mensaje'=>"Plan eliminado"],200);
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

        try{
            $this->planRepository->restore($plan);
        }catch (\Exception $exception){
            return response()->json(['error'=>$exception->getMessage()],422);
        }
        return response()->json(['mensaje'=>"Plan restaurado"],200);
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

    public function getRecipesForPlan()
    {
        $plan_id            = request('plan_id');
        $patient_id         = request('patient_id');
        $foods              = request('foods');
        $food_groups        = request('food_groups');
        $classifications    = request('classifications');
        $recipe_types       = request('recipe_types');
        $recipe_name        = request('recipe_name');
        $min_calorias       = request('min_calorias');
        $max_calorias       = request('max_calorias');
        $recipes_in_this_plan = [];
        $recipes_other_plans  = [];

        $recipes_already_used = PlanDetail::whereHas('plan',function ($query) use($patient_id){
                                                $query->where('patient_id',$patient_id);
                                            })
                                            ->with('recipe:id,origin_recipe_id')
                                            ->orderBY('plan_id','desc')
                                            ->groupBy(['plan_id','recipe_id'])
                                            ->get()
                                            ->toArray();

        foreach ($recipes_already_used as $row)
        {
            ## CHEQUEO QUE LA RECETA ESTE EDITADA PARA OBTENER EL ID DE LA RECETA PADRE O NO.
            if(is_null($row['recipe']['origin_recipe_id']))
                $recipe_id = $row['recipe_id'];
            else
                $recipe_id = $row['recipe']['origin_recipe_id'];

            if($row['plan_id'] == $plan_id)
                $recipes_in_this_plan[] = $recipe_id;
            else
                $recipes_other_plans[] = $recipe_id;
        }

        $query_recipes  = Recipe::with(['ingredients.food','classifications','recipeType'])
                                        ->has('ingredients')
                                        ->where('edit',false);

        if($classifications)
            $query_recipes->whereHas('classifications',function ($query)use($classifications){
                $query->whereIn('id',$classifications);
            });

        if($food_groups)
            $query_recipes->whereDoesntHave('ingredients.food',function ($query_food)use($food_groups){
                $query_food->whereIn('foods.food_group_id',$food_groups);
            });

        if($foods)
            $query_recipes->whereDoesntHave('ingredients',function ($query)use($foods){
                $query->whereIn('food_id',$foods);
            });

        if($recipe_types)
            $query_recipes->whereHas('recipeType',function ($query)use($recipe_types){
                $query->whereIn('id',$recipe_types);
            });

        if($recipe_name)
            $query_recipes->fullText($recipe_name);

        if($min_calorias)
            $query_recipes->where('total_energia_kcal','>=',$min_calorias);

        if($max_calorias)
            $query_recipes->where('total_energia_kcal','<=',$max_calorias);

        $recipes  = $query_recipes->get();
        $cantidad = $recipes->count();

        $html = (string) view('backend.admin.plan.partials.list-recipes',compact('recipes','recipes_in_this_plan','recipes_other_plans'));

        return compact('html','cantidad');
    }

    public function getModalRecipe(){
        if(request('recipe_id') && request('plan_id')){
            $recipe = Recipe::find(request('recipe_id'));
            $recipe->load('ingredients.food');
            $plan  = Plan::find(request('plan_id'));
            $array_dias = [];
            for ($i=1;$i<=$plan->days;$i++){
                $array_dias[$i] = "Día {$i}";
            }
            return view('backend.admin.plan.partials.modal-recipe',compact('recipe','array_dias'));
        }
        return App::abort(402);
    }

    public function addRecipeToPlan(){
        if(request('recipe_id') && request('plan_id')){
            try{
                $this->planRepository->addRecipe(request()->all());
                return response()->json(['mensaje'=>'Receta agregada'],200);
            }catch (\Exception $exception){
                return response()->json(['error'=>$exception->getMessage()],422);
            }
        }
        return App::abort(402);
    }

    public function getRecipe(){
        if(request('recipe_id') && request('plan_id'))
        {
            $recipe_original = Recipe::find(request('recipe_id'));
            $recipe          = $this->planRepository->copyRecipeToEdit($recipe_original);
            $recipe->load('ingredients.food');

            $plan       = Plan::find(request('plan_id'));
            $array_dias = [];

            for ($day=1;$day<=$plan->days;$day++){
                $array_dias[$day] = "Día {$day}";
            }

            $html = (string) view('backend.admin.plan.partials.modal-recipe-edit',compact('recipe','array_dias'));
            return response()->json(['html'=>$html],200);
        }
        return App::abort(402);
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

    public function getRecipesByDay(Plan $plan){
        $day  = request('day');

        $data =  PlanDetail::with(['recipe.observations','observations'])
                            ->where('day',$day)
                            ->where('plan_id',$plan->id)
                            ->orderBy('order')
                            ->get();

        return Datatables::of($data)
            ->addColumn('order',function ($row) use ($day,$plan){
                return view('backend.admin.plan.includes.plan-detail-day-order',compact('row','day','plan'));
            })
            ->addColumn('actions', function($row) use ($day){
                return view('backend.admin.plan.includes.datatable-plan-detail-by-day-buttons',compact('row','day'));
            })
            ->addColumn('recipe_name',function ($row){
                if($row->observations->isNotEmpty())
                    $observations = implode('. ', $row->observations->pluck('name')->toArray());
                else
                    $observations = implode('. ', $row->recipe->observations->pluck('name')->toArray());

                return "<span rel='tooltip' title='{$observations}'>{$row->recipe->name}</span>";
            })
            ->rawColumns(['actions','order','recipe_name'])
            ->make(true);
    }

    public function deleteDetailByDay(){
        if(request('id'))
        {
            $detail = PlanDetail::find(request('id'));

            $day    = $detail->day;
            $detail->observations()->detach();
            $detail->forceDelete();

            return response()->json(['mensaje'=>"Receta eliminada del día $day",'day'=>$day],200);
        }
        return App::abort(402);
    }

    public function getTotalRecipesByDay(Plan $plan)
    {
        if(request('day'))
        {
            $day = request('day');
            $total = [];
            $this->getValuesForDay($plan->id,$day,$total);
            return view('backend.admin.plan.partials.table-total-plan-by-day',
                        compact('total','plan','day'));
        }
        return App::abort(402);
    }

    public function getTotalCompletoPlanPorDia()
    {
        if(request('plan_id') && request('day'))
        {
            $day        = request('day');
            $plan_id    = request('plan_id');
            $total = [];
            $this->getValuesForDay($plan_id,$day,$total);
            return view('backend.admin.plan.partials.total-completo-plan-por-dia',compact('total'));
        }
        return App::abort(402);
    }

    private function getValuesForDay($plan_id,$day = null,&$total)
    {
        if(!is_null($day)){
            $plan_details =  PlanDetail::with('recipe')
                            ->where('day',$day)
                            ->where('plan_id',$plan_id)
                            ->get();
        }else{
            $plan_details =  PlanDetail::with('recipe')
                                        ->where('plan_id',$plan_id)
                                        ->get();
        }

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
        $total['total_riboflavina']             = 0;
        $total['total_niacina']                 = 0;
        $total['total_vitamina_c']              = 0;
        $total['total_carbohidratos_disponibles'] = 0;
        $total['total_ac_grasos_saturados']       = 0;
        $total['total_ac_grasos_monoinsaturados'] = 0;
        $total['total_ac_grasos_poliinsaturados'] = 0;
        $total['total_fibra']                     = 0;

        foreach ($plan_details as $detail)
        {
            $recipe = $detail->recipe;

            $total['total_energia_kcal']            += $recipe->total_energia_kcal;
            $total['total_proteina']                += $recipe->total_proteina;
            $total['total_grasa_total']             += $recipe->total_grasa_total;
            $total['total_carbohidratos_totales']   += $recipe->total_carbohidratos_totales;
            $total['total_colesterol']              += $recipe->total_colesterol;
            $total['total_agua']                    += $recipe->total_agua;
            $total['total_cenizas']                 += $recipe->total_cenizas;
            $total['total_sodio']                   += $recipe->total_sodio;
            $total['total_potasio']                 += $recipe->total_potasio;
            $total['total_calcio']                  += $recipe->total_calcio;
            $total['total_fosforo']                 += $recipe->total_fosforo;
            $total['total_hierro']                  += $recipe->total_hierro;
            $total['total_zinc']                    += $recipe->total_zinc;
            $total['total_tiamina']                 += $recipe->total_tiamina;
            $total['total_riboflavina']             += $recipe->total_riboflavina;
            $total['total_niacina']                 += $recipe->total_niacina;
            $total['total_vitamina_c']              += $recipe->total_vitamina_c;
            $total['total_carbohidratos_disponibles']  += $recipe->total_carbohidratos_disponibles;
            $total['total_ac_grasos_saturados']        += $recipe->total_ac_grasos_saturados;
            $total['total_ac_grasos_monoinsaturados']  += $recipe->total_ac_grasos_monoinsaturados;
            $total['total_ac_grasos_poliinsaturados']  += $recipe->total_ac_grasos_poliinsaturados;
            $total['total_fibra']                      += $recipe->total_fibra;
        }
    }

    public function downloadPlan(Plan $plan)
    {
        if($plan->open)
            return redirect()->route('admin.plan.index')->with(['error'=>'Debe cerrar el plan para descargarlo']);

        $basic_information = BasicInformation::with(['imageRecommendations','textRecommendations'])->first();

        if(!$basic_information)
            return redirect()->route('admin.plan.index')->with(['error'=>'Configure su información personal para descargar el plan']);

        $details_without_order = $plan->details()->where(function ($query_where){
                                        $query_where->whereNull('order')
                                                ->orWhereNull('order_type');
                                    })->first();

        if($details_without_order)
            return redirect()->route('admin.plan.index')->with(['error'=>'Debe ordenar el plan para descargarlo']);

        $plan->load('patient');

        $patient = $plan->patient;
        $details = PlanDetail::with(['recipe.ingredients.food','observations'])
                                    ->where('plan_id',$plan->id)
                                    ->orderBy('day','asc')
                                    ->orderBy('order','asc')
                                    ->get();
        $macros = false;
        if(request('macros'))
            $macros = true;

        $view_by_day = "";

        for ($day=1;$day<=$plan->days;$day++)
        {
            $details_by_day = $details->filter(function ($detail) use($day){
                                            return $detail->day == $day;
                                    });

            if($details_by_day->isEmpty())
                return redirect()->route('admin.plan.index')->with(['error'=>"Debe completar el plan. El día {$day} no tiene recetas"]);

            $view_by_day .= view('backend.admin.plan.table_by_day_with_order',compact('day','details_by_day','macros'));
        }

        $header            = view('backend.admin.plan.header_plan_pdf',compact('plan','patient','basic_information'));
        $final_data        = view('backend.admin.plan.final_data_plan_pdf',compact('basic_information'));
        $nombre_plan       = strtolower(trim($plan->name));
        $nombre_archivo    = snake_case("{$nombre_plan}_{$patient->full_name}");

        PDF::setOption('header-font-name','Bebas Neue');

        $pdf = PDF::loadView('backend.admin.plan.pdf',compact('plan','patient','view_by_day','header','final_data','basic_information'));

        return $pdf->download("{$nombre_archivo}.pdf");
    }

    public function downloadPlanWord(Plan $plan)
    {
        if($plan->open)
            return redirect()->route('admin.plan.index')->with(['error'=>'Debe cerrar el plan para descargarlo']);

        $basic_information = BasicInformation::with(['imageRecommendations','textRecommendations'])->first();

        if(!$basic_information)
            return redirect()->route('admin.plan.index')->with(['error'=>'Configure su información personal para descargar el plan']);

        $details_without_order = $plan->details()->where(function ($query_where){
                                            $query_where->whereNull('order')
                                                ->orWhereNull('order_type');
                                        })->first();

        if($details_without_order)
            return redirect()->route('admin.plan.index')->with(['error'=>'Debe ordenar el plan para descargarlo']);

        $plan->load('patient');

        $patient = $plan->patient;
        $details = PlanDetail::with(['recipe.ingredients.food','observations'])
                            ->where('plan_id',$plan->id)
                            ->orderBy('day','asc')
                            ->orderBy('order','asc')
                            ->get();

        $macros = false;
        if(request('macros'))
            $macros = true;

        $view_by_day = "";

        for ($day=1;$day<=$plan->days;$day++)
        {
            $details_by_day = $details->filter(function ($detail) use($day){
                return $detail->day == $day;
            });

            if($details_by_day->isEmpty())
                return redirect()->route('admin.plan.index')->with(['error'=>"Debe completar el plan. El día {$day} no tiene recetas"]);

            $view_by_day .= view('backend.admin.plan.table_by_day_with_order_word',compact('day','details_by_day','macros'));
        }

        $header            = view('backend.admin.plan.header_plan_word',compact('plan','patient','basic_information'));
        $final_data        = view('backend.admin.plan.final_data_plan_word',compact('basic_information'));
        $nombre_plan       = strtolower(trim($plan->name));
        $nombre_archivo    = snake_case("{$nombre_plan}_{$patient->full_name}");

        $headers = [
            "Content-type"=>"text/html",
            "Content-Disposition"=>"attachment;Filename={$nombre_archivo}.docx"
        ];

        $content = (string) view('backend.admin.plan.word',compact('plan','patient','view_by_day','header','final_data','basic_information'));

        return \Response::make($content,200, $headers);
    }

    public function storeOrderPlanDetailDay()
    {
       if(request('values'))
       {
          foreach (request('values') as $value)
          {
              $plan_detail = PlanDetail::find($value['id']);
              $plan_detail->order = $value['order'];
              $plan_detail->order_type = $value['order_type'];
              $plan_detail->save();
          }
          return response()->json(['mensaje'=>"Orden de recetas guardada con éxito"],200);
       }
       return App::abort(402);
    }

    public function closePlan(Plan $plan)
    {

        if (!auth()->user()->isAdmin())
            return response()->json(['error'=>"No tiene permiso para eliminar"],422);

        $details_without_order = $plan->details()->where(function ($query_where){
            $query_where->whereNull('order')
                ->orWhereNull('order_type');
        })->first();

        if($details_without_order)
            return response()->json(['error'=>"Debe ordenar el plan para cerrarlo"],422);

        $plan->load('details');
        $details = $plan->details;
        for ($day=1;$day<=$plan->days;$day++)
        {
            $details_by_day = $details->filter(function ($detail) use($day){
                return $detail->day == $day;
            });

            if($details_by_day->isEmpty())
                return response()->json(['error'=>"Debe completar el plan. El día {$day} no tiene recetas"],422);
        }

        $plan->open = false;
        $plan->save();

        return response()->json(['mensaje'=>"Plan Cerrado"],200);

    }

    public function openPlan(Plan $plan)
    {
        $plan->open = true;
        $plan->save();
        return response()->json(['mensaje'=>"Plan Re Abierto"],200);
    }

    public function editRecipeAdded()
    {
        if(request('plan_detail_id'))
        {
            $detail = PlanDetail::find(request('plan_detail_id'));
            $detail->load('recipe');
            $recipe = $this->planRepository->copyRecipeToEdit($detail->recipe);

            $detail->recipe_id = $recipe->id;
            $detail->save();

            $recipe->load('ingredients.food');
            $day     = $detail->day;
            $plan_id = $detail->plan_id;

            $html = (string) view('backend.admin.plan.partials.modal-recipe-edit',compact('recipe','day','plan_id'));
            return response()->json(['html'=>$html,'day'=>$day],200);
        }
    }

    public function updateRecipeName()
    {
        if(request('new_name') && request('recipe_id'))
        {
            $recipe = Recipe::find(request('recipe_id'));
            $recipe->name = request('new_name');
            $recipe->save();
            return response()->json(['mensaje'=>"Nombre actualizado"],200);
        }
    }

    public function calculateEnergySpending()
    {
        $data = request()->all();
        $data['weight'] = (double) str_replace(',','.',$data['weight']);
        $data['height'] = (double) str_replace(',','.',$data['height']);
        $result = 0;
        switch($data['method'])
        {
            case Plan::harris_benedict:
                $data['activity'] = (double) $data['activity'];
                $result = Plan::calculateTMBHarrisBenedict($data);
                break;
            case Plan::mifflin_st_jeor:
                $data['activity'] = (double) $data['activity'];
                $result = Plan::calculateTMBMifflin($data);
                break;
            case Plan::factorial_fao_homs:
                $result = Plan::calculateTMBFactorial($data);
                break;
        }

        return response()->json(['result'=>$result],200);
    }

    public function storeEnergySpending(Plan $plan)
    {
        if(request('method_result'))
        {

            $plan->method = request('method');
            $plan->weight = str_replace(',','.',request('weight'));
            $plan->height = str_replace(',','.',request('height'));
            $plan->age    = request('age');
            $plan->activity = request('activity') ? request('activity') : null;

            if(request('tmb'))
            {
                $tmb        = str_replace('.','',request('tmb'));
                $tmb        = str_replace(',','.',$tmb);
                $plan->tmb  = $tmb;
            }

            $method_result        = str_replace('.','',request('method_result'));
            $method_result        = str_replace(',','.',$method_result);
            $plan->method_result  = $method_result;

            $plan->save();
            return response()->json(['mensaje'=>'Valores Guardados Correctamente'],200);

        }
    }

    public function storeActivityFao(Plan $plan)
    {
        if(request('total')){
            try{
                $this->planRepository->addActivityFao(request()->all(),$plan);
                $values = $this->planRepository->calculateTotalFao($plan);

                return response()->json(['mensaje'=>'Actividad agregada','values'=>$values],200);
            }catch (\Exception $exception){
                return response()->json(['error'=>$exception->getMessage()],422);
            }
        }
        return App::abort(402);
    }

    public function getEnergySpending(Plan $plan)
    {
        $plan->load('energySpendings');
        $data =  $plan->energySpendings;

        return Datatables::of($data)
            ->editColumn('activity',function ($row){
                return PlanEnergySpending::$activities_fao_oms[$row->activity];
            })
            ->addColumn('actions', function($row){
                return view('backend.admin.plan.includes.datatable-plan-spending-energy-buttons',compact('row'));
            })
            ->rawColumns(['actions','order'])
            ->make(true);
    }

    public function deleteActivityFao()
    {
        if(request('id'))
        {
            $plan_spending = PlanEnergySpending::find(request('id'));
            $plan_spending->forceDelete();
            return response()->json(['mensaje'=>'Actividad Eliminada'],200);
        }
        return App::abort(402);
    }

    public function getAMMValues(Plan $plan)
    {
        $amm_hours = $this->planRepository->calculateAMMValues($plan);

        if(!$amm_hours)
            return response()->json(['error'=>'Debe agregar una actividad antes de calcular los valores de AMM'],422);

        return response()->json(['amm_hours'=>$amm_hours],200);

    }

    public function getTotalActivitiesFao(Plan $plan)
    {
        try{
            $values = $this->planRepository->calculateTotalFao($plan);
            return response()->json(['values'=>$values],200);
        }catch (\Exception $exception){
            return response()->json(['error'=>$exception->getMessage()],422);
        }
    }

    public function modalObservations()
    {
        if(request('plan_detail_id'))
        {
            $plan_detail  = PlanDetail::find(request('plan_detail_id'));
            $plan_detail->load('observations');

            $observations             = Observation::pluck('name','id');
            $observations_plan_detail = $plan_detail->observations->pluck('id');

            return view('backend.admin.plan.partials.modal-observation',compact('plan_detail','observations','observations_plan_detail'));
        }

        return App::abort(402);
    }

    public function addObservation()
    {
        if(request('plan_detail_id'))
        {
            $plan_detail  = PlanDetail::find(request('plan_detail_id'));

            if(request('observations'))
                $plan_detail->observations()->sync(request('observations'));
            else
                $plan_detail->observations()->detach();

            $day = $plan_detail->day;

            return response()->json(['mensaje'=>'Observaciónes actualizadas','day'=>$day],200);
        }

        return App::abort(402);
    }



    public function addNewObservation()
    {
        if(request('plan_detail_id') && request('name'))
        {
            $observation = new Observation();
            $observation->name = request('name');
            $observation->save();

            return response()->json(['observation'=>$observation],200);
        }

        return App::abort(402);
    }
}
