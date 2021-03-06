<?php

namespace App\Http\Controllers\Backend\Admin;

use App;
use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Ingredient;
use App\Repositories\Backend\Admin\RecipeRepository;
use App\Repositories\Backend\Admin\ObservationRepository;
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
    protected $observationRepository;

    /**
     * @param RecipeRepository $recipeRepository
     * @param ObservationRepository $observationRepository
     */

    public function __construct(RecipeRepository $recipeRepository,ObservationRepository  $observationRepository)
    {
        $this->recipeRepository = $recipeRepository;
        $this->observationRepository = $observationRepository;
    }

    /**
     * @param ManageRecipeRequest $request
     *
     * @return mixed
     */
    public function index(ManageRecipeRequest $request)
    {
        if ($request->ajax()) {
            $data = Recipe::with('recipeType', 'classifications')->where('edit', false)->orderBy('name')->get();
            return Datatables::of($data)
                ->addColumn('actions', function ($row) {
                    return view('backend.admin.recipe.includes.datatable-buttons', compact('row'));
                })
                ->editColumn('recipeType', function ($row) {
                    return $row->recipeType->name;
                })
                ->editColumn('classifications', function ($row) {
                    $clasifications = $row->classifications->pluck('name')->toArray();
                    return implode('/', $clasifications);
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
    public function indexEdit(ManageRecipeRequest $request)
    {
        if ($request->ajax()) {
            $data = Recipe::where('edit', true)
                            ->has('planDetails')
                            ->with('recipeType', 'classifications')
                            ->orderBy('name')
                            ->get();

            return Datatables::of($data)
                ->addColumn('actions', function ($row) {
                    return view('backend.admin.recipe.includes.datatable-edit-buttons', compact('row'));
                })
                ->editColumn('recipeType', function ($row) {
                    return $row->recipeType->name;
                })
                ->editColumn('classifications', function ($row) {
                    $clasifications = $row->classifications->pluck('name')->toArray();
                    return implode('/', $clasifications);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.recipe.index-edit');
    }

    public function viewRecipe()
    {
        if(request('recipe_id'))
        {
            $recipe = Recipe::find(request('recipe_id'));
            $recipe->load('ingredients.food');
            return view('backend.admin.recipe.partials.modal-recipe',compact('recipe'));
        }
        return App::abort(402);
    }

    public function updateRecipe()
    {
        if(request('recipe_id'))
        {
            $recipe = Recipe::find(request('recipe_id'));
            $recipe->edit = false;
            $recipe->save();
            return response()->json(['mensaje' => "Receta actualizada"], 200);
        }
        return App::abort(402);
    }

    /**
     * @param ManageRecipeRequest $request
     *
     * @return mixed
     */
    public function create(ManageRecipeRequest $request)
    {
        $validator = JsValidator::formRequest(StoreRecipeRequest::class);
        return view('backend.admin.recipe.create', compact('validator'));
    }

    /**
     * @param StoreRecipeRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function store(StoreRecipeRequest $request)
    {
        try {
            $recipe = $this->recipeRepository->create($request->all());
        } catch (\Exception $exception) {
            Session::flash('error', $exception->getMessage());
            return redirect()->route('admin.recipe.create')->withInput($request->all());
        }

        Session::flash('success', 'Receta Creada');
        return redirect()->route('admin.recipe.edit', compact('recipe'));
    }

    /**
     * @param ManageRecipeRequest $request
     * @param Recipe $recipe
     *
     * @return mixed
     */
    public function edit(ManageRecipeRequest $request, Recipe $recipe)
    {
        if (!auth()->user()->isAdmin()) {
            Session::flash('error', 'No tiene permiso para editar');
            return redirect()->route('admin.recipe.index');
        }
        $validator = JsValidator::formRequest(UpdateRecipeRequest::class);
        $classifications = $recipe->classifications->pluck('id');
        $observations = $recipe->observations->pluck('id');

        return view('backend.admin.recipe.edit', compact('recipe', 'validator', 'classifications', 'observations'));
    }

    /**
     * @param UpdateRecipeRequest $request
     * @param Recipe $recipe
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        try {
            $this->recipeRepository->update($request->all(), $recipe);
        } catch (\Exception $exception) {
            Session::flash('error', $exception->getMessage());
            return redirect()->route('admin.recipe.edit', compact('recipe'))->withErrors($request)->withInput($request->all());
        }
        Session::flash('success', 'Receta Actualizada');
        return redirect()->route('admin.recipe.index');
    }

    /**
     * @param ManageRecipeRequest $request
     * @param Recipe $recipe
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageRecipeRequest $request, Recipe $recipe)
    {
        if (!auth()->user()->isAdmin()) {
            return response()->json(['error' => "No tiene permiso para eliminar"], 422);
        }

        $recipe->load('planDetails.plan');

        if ($recipe->planDetails->isNotEmpty()) {
            $details = $recipe->planDetails;
            foreach ($details as $detail) {
                $plan = $detail->plan;
                if ($plan && is_null($plan->deleted_at)) {
                    return response()->json(['error' => "La receta forma parte del plan {$plan->name} que esta habilitado."], 422);
                }
            }
        }

        $ingredients = $recipe->ingredients;
        foreach ($ingredients as $ingredient) {
            $ingredient->delete();
        }
        $this->recipeRepository->deleteById($recipe->id);

        return response()->json(['mensaje' => "Receta eliminada"], 200);
    }

    public function getDeleted(ManageRecipeRequest $request)
    {
        if ($request->ajax()) {
            $data = $this->recipeRepository->getDeletedPaginated(25, 'id', 'asc');
            return Datatables::of($data)
                ->addColumn('actions', function ($row) {
                    return view('backend.admin.recipe.includes.datatable-buttons', compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.admin.recipe.deleted');
    }

    /**
     * @param ManageRecipeRequest $request
     * @param integer $id
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageRecipeRequest $request, $id)
    {
        $recipe = Recipe::onlyTrashed()->find($id);
        try {
            $this->recipeRepository->restore($recipe);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 422);
        }
        return response()->json(['mensaje' => "Receta restaurada"], 200);
    }

    public function getIngredients()
    {
        if (request('recipe_id')) {
            $recipe = Recipe::find(request('recipe_id'));
            $data = Ingredient::with(['food'])
                ->where('recipe_id', $recipe->id)
                ->orderBy('quantity_grs', 'asc')
                ->get();
            return Datatables::of($data)
                ->addColumn('actions', function ($row) {
                    return view('backend.admin.recipe.includes.datatable-ingredients-buttons', compact('row'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    public function searchIngredients()
    {
        $buscar = trim(request('q'));

        if (empty($buscar)) {
            return \Response::json([]);
        }

        $query = Food::fullText($buscar);
        $foods = $query->limit(20)
            ->orderBy('name')
            ->get(['id', 'name'])
            ->toArray();

        $foods = array_map(function ($item) {
            return ['id' => $item['id'], 'text' => $item['name']];
        }, $foods);

        return \Response::json($foods);
    }

    public function addIngredients()
    {
        if (request('recipe_id')) {
            $recipe = Recipe::find(request('recipe_id'));
            try {
                if (request('ingredient_id')) {
                    $this->recipeRepository->updateIngredient(request()->all());
                    return response()->json(['mensaje' => 'Ingrediente actualizado', 'edit' => true], 200);
                } else {
                    $ingredient_exist = Ingredient::where('recipe_id', $recipe->id)
                        ->where('food_id', request('food_id'))
                        ->first();
                    if ($ingredient_exist) {
                        return response()->json(['error' => 'El alimento que intenta agregar ya esta en la receta'], 422);
                    }
                    $this->recipeRepository->addIngredient($recipe, request());
                    return response()->json(['mensaje' => 'Ingrediente agregado', 'edit' => false], 200);
                }
            } catch (\Exception $exception) {
                return response()->json(['error' => $exception->getMessage()], 422);
            }
        }
        return App::abort(402);
    }

    public function deleteIngredient()
    {
        if (request('ingredient_id')) {
            $ingredient = Ingredient::find(request('ingredient_id'));
            if ($ingredient) {
                if (!$ingredient->forceDelete()) {
                    return response()->json(['error' => 'Error al eliminar ingrediente'], 422);
                }
                return response()->json(['mensaje' => 'Ingrediente eliminado'], 200);
            }
            return App::abort(402);
        }
        return App::abort(402);
    }

    public function getIngredient()
    {
        if (request('ingredient_id')) {
            $ingredient = Ingredient::find(request('ingredient_id'));
            if ($ingredient) {
                return ['ingredient' => $ingredient, 'food' => $ingredient->food];
            }
            return App::abort(402);
        }
        return App::abort(402);
    }

    public function getTotal()
    {
        if (request('recipe_id')) {
            $recipe = Recipe::find(request('recipe_id'));
            if ($recipe) {
                return view('backend.admin.recipe.partials.table-total-recipe', compact('recipe'));
            }
        }
        return App::abort(402);
    }

    public function getTotalCompleto()
    {
        if (request('recipe_id')) {
            $recipe = Recipe::find(request('recipe_id'));
            if ($recipe) {
                return view('backend.admin.recipe.partials.total-completo-recipe', compact('recipe'));
            }
        }
        return App::abort(402);
    }

    public function calculateGrs()
    {
        if (request('quantity') && request('food_id')) {
            $quantity_grs = request('quantity');
            $food = Food::find(request('food_id'));

            $total_energia_kcal = $food->energia_kcal > 0 ? round((($quantity_grs * $food->energia_kcal) / 100), 3) : 0;
            $total_proteina     = $food->proteina > 0 ? round((($quantity_grs * $food->proteina) / 100), 3) : 0;
            $total_grasa_total  = $food->grasa_total > 0 ? round((($quantity_grs * $food->grasa_total) / 100), 3) : 0;
            $total_carbohidratos_totales = $food->carbohidratos_totales > 0 ? round((($quantity_grs * $food->carbohidratos_totales) / 100), 3) : 0;
            $total_colesterol = $food->colesterol > 0 ? round((($quantity_grs * $food->colesterol) / 100), 3) : 0;

            return view('backend.admin.recipe.partials.table-calculate-grs-modal', compact('total_energia_kcal', 'total_proteina',
                'total_grasa_total', 'total_carbohidratos_totales', 'total_colesterol'));

        }
    }

    public function copyRecipe(Recipe $recipe)
    {
        try {
            $name = request('name');
            if (empty($name))
                throw  new \Exception("Ingrese un nombre por favor");

            $this->recipeRepository->copyRecipe($recipe, $name);
            return response()->json(['mensaje' => "Receta Copiada"], 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 422);
        }
    }

    public function storeObservation()
    {
        if(request('observation'))
        {
            try {
                $name = request('observation');
                if (empty($name))
                    throw  new \Exception("Ingrese un nombre por favor");

                $observation = $this->observationRepository->create(['name'=>$name]);
                return response()->json(['mensaje' => "Observación Agregada",'observation'=>$observation], 200);
            } catch (\Exception $exception) {
                return response()->json(['error' => $exception->getMessage()], 422);
            }
        }
    }
}
