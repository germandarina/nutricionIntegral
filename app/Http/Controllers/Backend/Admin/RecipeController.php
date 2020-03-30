<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Ingredient;
use App\Repositories\Backend\Admin\RecipeRepository;
use App\Http\Requests\Backend\Admin\Recipe\StoreRecipeRequest;
use App\Http\Requests\Backend\Admin\Recipe\ManageRecipeRequest;
use App\Http\Requests\Backend\Admin\Recipe\UpdateRecipeRequest;
use JsValidator;
use Request;
use Session;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Recipe;

/**
 * Class RecipeController.
 */
class RecipeController extends Controller
{
    /**
     * @var RecipeRepository
     */
    protected $recipeRepository;

    /**
     * @param RecipeRepository       $recipeRepository
     */
    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    /**
     * @param ManageRecipeRequest $request
     *
     * @return mixed
     */
    public function index(ManageRecipeRequest $request)
    {
        if ($request->ajax()) {
            $data = $this->recipeRepository->orderBy('id')->get();
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    return view('backend.admin.recipe.includes.datatable-buttons',compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.recipe.index');
    }

    /**
     * @param ManageRecipeRequest $request
     *
     * @return mixed
     */
    public function create(ManageRecipeRequest $request)
    {
        $validator = JsValidator::formRequest(StoreRecipeRequest::class);
        return view('backend.admin.recipe.create',compact('validator'));
    }

    /**
     * @param StoreRecipeRequest $request
     *
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function store(StoreRecipeRequest $request)
    {
        $recipe = $this->recipeRepository->create($request->all());
        Session::flash('success','Receta Creada');
        return redirect()->route('admin.recipe.edit',compact('recipe'));
    }

    /**
     * @param ManageRecipeRequest $request
     * @param Recipe              $recipe
     *
     * @return mixed
     */
    public function edit(ManageRecipeRequest $request, Recipe $recipe)
    {
        if (!auth()->user()->isAdmin()) {
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('admin.recipe.index');
        }
        $validator = JsValidator::formRequest(UpdateRecipeRequest::class);
        $classifications = $recipe->classifications->pluck('id');
        return view('backend.admin.recipe.edit',compact('recipe','validator','classifications'));
    }

    /**
     * @param UpdateRecipeRequest $request
     * @param Recipe              $recipe
     * @return mixed
     *@throws \App\Exceptions\GeneralException
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        $this->recipeRepository->update($request->all(), $recipe);
        Session::flash('success','Receta Actualizada');
        return redirect()->route('admin.recipe.index');
    }

    /**
     * @param ManageRecipeRequest $request
     * @param Recipe              $recipe
     *
     * @return mixed
     *@throws \Exception
     */
    public function destroy(ManageRecipeRequest $request, Recipe $recipe)
    {
        if (!auth()->user()->isAdmin()) {
            Session::flash('error','No tiene permiso para editar');
            return redirect()->route('admin.recipe.index');
        }

        $this->recipeRepository->deleteById($recipe->id);
        Session::flash('success','Receta eliminada');
        return redirect()->route('admin.recipe.index');
    }

    public function getDeleted(ManageRecipeRequest $request){
        if ($request->ajax()) {
            $data = $this->recipeRepository->getDeletedPaginated(25, 'id', 'asc');
            return Datatables::of($data)
                ->addColumn('actions', function($row){
                    return view('backend.admin.recipe.includes.datatable-buttons',compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.recipe.deleted');
    }

    /**
     * @param ManageRecipeRequest $request
     * @param integer              $id
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function restore(ManageRecipeRequest $request, $id)
    {
        $recipe = Recipe::onlyTrashed()->find($id);
        $this->recipeRepository->restore($recipe);
        Session::flash('success','Receta restaurada');
        return redirect()->route('admin.recipe.index');
    }

    public function getIngredients(Recipe $recipe){
        $data =  Ingredient::with('food')->where('recipe_id',$recipe->id)->get();
        return Datatables::of($data)
            ->addColumn('actions', function($row){
                return view('backend.admin.recipe.includes.datatable-ingredients-buttons',compact('row'));
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function searchIngredients(){
        $buscar = trim(request('q'));
        $food_group_id = trim(request('food_group_id'));
        if (empty($buscar)) {
            return \Response::json([]);
        }
        $query = Food::where('foods.name','like',"%$buscar%");
        if($food_group_id){
            $query->where('food_group_id',$food_group_id);
        }
        $foods = $query->limit(20)->get(['id','name']);
        $array_foods = [];
        foreach ($foods as $food) {
            $array_foods[] = ['id' => $food->id, 'text' => $food->name];
        }
        return \Response::json($array_foods);
    }
}
