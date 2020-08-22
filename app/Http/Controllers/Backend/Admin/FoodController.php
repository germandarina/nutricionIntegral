<?php

namespace App\Http\Controllers\Backend\Admin;

use App;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Admin\FoodRepository;
use App\Http\Requests\Backend\Admin\Food\StoreFoodRequest;
use App\Http\Requests\Backend\Admin\Food\ManageFoodRequest;
use App\Http\Requests\Backend\Admin\Food\UpdateFoodRequest;
use JsValidator;
use Session;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Food;
use Illuminate\Support\Facades\DB;

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
            $data = Food::with('foodGroup')->orderBy('name')->get();
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    return view('backend.admin.food.includes.datatable-buttons',compact('row'));
                })
                ->editColumn('foodGroup',function ($row){
                    return $row->foodGroup->name;
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
        try{
            $this->foodRepository->create($request->all());
        }catch (\Exception $exception){
            Session::flash('error',$exception->getMessage());
            return redirect()->route('admin.food.create')->withInput($request->all());
        }
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
        try{
            $this->foodRepository->update($request->all(), $food);
        }catch (\Exception $exception){
            Session::flash('error',$exception->getMessage());
            return redirect()->route('admin.food.edit',compact('food'))->withInput($request->all());
        }
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
            return response()->json(['mensaje'=>"No tiene permiso para eliminar"],422);
        }

        $food->load('ingredients');

        if($food->ingredients->isNotEmpty()){
            return response()->json(['mensaje'=>"El alimento ya forma parte de una receta"],422);
        }

        $this->foodRepository->deleteById($food->id);
        return response()->json(['mensaje'=>"Alimento eliminado"],200);
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
        try{
            $this->foodRepository->restore($food);
        }catch (\Exception $exception){
            return response()->json(['error'=>$exception->getMessage()],422);
        }
        return response()->json(['mensaje'=>"Alimento restaurado"],200);
    }

    public function importarAlimentos(){
        try{
            DB::beginTransaction();
            $alimentos_importar = DB::select("select * from importacion_alimentos");
            if(!empty($alimentos_importar)){
                foreach ($alimentos_importar as $fila){
                    $existe = Food::where('name',trim($fila->nombre))
                                    ->where('food_group_id',$fila->grupo_alimento)
                                    ->first();
                    if($existe){
                        $alimento = $existe;
                    }else{
                        $alimento = new Food();

                    }
                    $alimento->name = trim($fila->nombre);
                    $alimento->food_group_id = $fila->grupo_alimento;
                    $alimento->energia_kj = empty($fila->energia_kj) || $fila->energia_kj == '...' ? 0 : (float) str_replace(',','.',$fila->energia_kj);
                    $alimento->energia_kcal = empty($fila->energia_kcal) || $fila->energia_kcal == '...' ? 0: (float) str_replace(',','.',$fila->energia_kcal);
                    $alimento->agua = empty($fila->agua) || $fila->agua == '...' ? 0: (float) str_replace(',','.',$fila->agua);
                    $alimento->proteina = is_null($fila->proteina) || empty($fila->proteina) || $fila->proteina == '...' ? 0 : (float) str_replace(',','.', $fila->proteina);
                    $alimento->grasa_total = empty($fila->grasa_total) || $fila->grasa_total == '...' ? 0: (float) str_replace(',','.',$fila->grasa_total);
                    $alimento->carbohidratos_totales = empty($fila->carbohidratos_totales) || $fila->carbohidratos_totales == '...' ? 0: (float) str_replace(',','.',$fila->carbohidratos_totales);
                    $alimento->cenizas = empty($fila->cenizas) || $fila->cenizas == '...' ? 0: (float) str_replace(',','.',$fila->cenizas);
                    $alimento->sodio = empty($fila->sodio) || $fila->sodio == '...' ? 0: (float) str_replace(',','.',$fila->sodio);
                    $alimento->potasio = empty($fila->potasio) || $fila->potasio == '...' ? 0: (float) str_replace(',','.',$fila->potasio);
                    $alimento->calcio = empty($fila->calcio) || $fila->calcio == '...' ? 0: (float) str_replace(',','.',$fila->calcio);
                    $alimento->fosforo = empty($fila->fosforo) || $fila->fosforo == '...' ? 0: (float) str_replace(',','.',$fila->fosforo);
                    $alimento->hierro = empty($fila->hierro) || $fila->hierro == '...' ? 0: (float) str_replace(',','.',$fila->hierro);
                    $alimento->zinc = empty($fila->zinc) || $fila->zinc == '...' ? 0: (float) str_replace(',','.',$fila->zinc);
                    $alimento->tiamina = empty($fila->tiamina) || $fila->tiamina == '...' ? 0: (float) str_replace(',','.',$fila->tiamina);
                    $alimento->rivoflavina = empty($fila->rivoflavina) || $fila->rivoflavina == '...' ? 0: (float) str_replace(',','.',$fila->rivoflavina);
                    $alimento->niacina = empty($fila->niacina) || $fila->niacina == '...' ? 0: (float) str_replace(',','.',$fila->niacina);
                    $alimento->vitamina_c = empty($fila->vitamina_c) || $fila->vitamina_c == '...' ? 0: (float) str_replace(',','.',$fila->vitamina_c);
                    $alimento->carbohidratos_disponibles = empty($fila->carbohidratos_disponibles) || $fila->carbohidratos_disponibles == '...' ? 0: (float) str_replace(',','.',$fila->carbohidratos_disponibles);
                    $alimento->ac_grasos_saturados = empty($fila->ac_grasos_saturados) || $fila->ac_grasos_saturados == '...' ? 0: (float) str_replace(',','.',$fila->ac_grasos_saturados);
                    $alimento->ac_grasos_monoinsaturados = empty($fila->ac_grasos_monoinsaturados) || $fila->ac_grasos_monoinsaturados == '...' ? 0: (float) str_replace(',','.',$fila->ac_grasos_monoinsaturados);
                    $alimento->ac_grasos_poliinsaturados = empty($fila->ac_grasos_poliinsaturados) || $fila->ac_grasos_poliinsaturados == '...' ? 0: (float) str_replace(',','.',$fila->ac_grasos_poliinsaturados);
                    $alimento->colesterol = empty($fila->colesterol) || $fila->colesterol == '...' ? 0: (float) str_replace(',','.',$fila->colesterol);
                    if(!$alimento->save()){
                        throw new \Exception("Error al importar alimento".$fila->nombre);
                    }
                }
            }
            DB::commit();
            echo "termine bien la importacion";
        }catch (\Exception $exception){
            DB::rollBack();
            echo $exception->getMessage();
        }
    }

    public function getComposicion(){
        if(request('food_id')){
            $food = Food::find(request('food_id'));
            if($food){
                return view('backend.admin.food.partials.table-composicion-modal',compact('food'));
            }
        }
    }

    public function getComposicionCompleta(){
        if(request('food_id')){
            $food = Food::find(request('food_id'));
            if($food){
                return view('backend.admin.food.partials.composicion-completa-modal',compact('food'));
            }
        }
    }
}
