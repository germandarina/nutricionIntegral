<?php

namespace App\Repositories\Backend\Admin;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Session;

/**
 * Class RecipeRepository.
 */
class RecipeRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Recipe::class;
    }

    /**
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return Recipe
     */
    public function create(array $data) : Recipe
    {

        return DB::transaction(function () use ($data) {

//            $data['name'] = $this->model->_sanear_string($data['name']);

            $recipe = parent::create($data);

            if ($recipe) {
                $recipe->classifications()->attach($data['classifications']);
                return $recipe;
            }
            throw new GeneralException('Error al crear receta. Intente nuevamente');
        });
    }

    /**
     * @param Recipe  $recipe
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(array $data, Recipe $recipe)
    {
        if (!auth()->user()->isAdmin()) {
            throw new GeneralException('No tiene permiso para realizar esta acción');
        }

        return DB::transaction(function () use ($recipe, $data) {
//            $data['name'] = $this->model->_sanear_string($data['name']);
            if (!$recipe->update($data)) {
                throw new GeneralException('Error al actualizar receta. Intente nuevamente');
            }
            $recipe->classifications()->sync($data['classifications']);
            return $recipe;
        });
    }

    /**
     * @param $name
     *
     * @return bool
     */
    protected function recipeExists($name) : bool
    {
        return $this->model
            ->where('name', strtolower($name))
            ->count() > 0;
    }

    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */

    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc')
    {
        return $this->model
//            ->with('roles', 'permissions', 'providers')
            ->onlyTrashed()
            ->orderBy($orderBy, $sort);
        //->paginate($paged);
    }

    /**
     * @param Recipe $recipe
     *
     * @throws GeneralException
     * @return Recipe
     */
    public function restore(Recipe $recipe) : Recipe
    {
        if (is_null($recipe->deleted_at)) {
            throw new GeneralException('El receta no esta eliminado');
        }
        if ($recipe->restore()) {
            return $recipe;
        }

        throw new GeneralException('Error al restaurar receta. Intente nuevamente');
    }

    public function addIngredient(Recipe $recipe,$data){
        if (!auth()->user()->isAdmin()) {
            throw new GeneralException('No tiene permiso para realizar esta acción');
        }

        return DB::transaction(function () use ($recipe, $data) {
            $ingredient = new Ingredient();
            $data['recipe_id'] = $recipe->id;
            $ingredient->fill($data->all());
            if (!$ingredient->save()) {
                throw new GeneralException('Error al agregar ingrediente. Intente nuevamente',422);
            }
            return $ingredient;
        });
    }

    public function updateIngredient($data){
        if (!auth()->user()->isAdmin()) {
            throw new GeneralException('No tiene permiso para realizar esta acción');
        }

        return DB::transaction(function () use ($data) {
            $ingredient = Ingredient::find($data['ingredient_id']);
            if (!$ingredient->update($data)) {
                throw new GeneralException('Error al actualizar ingrediente. Intente nuevamente',422);
            }
            return $ingredient;
        });
    }

    public function copyRecipe(Recipe $recipe_original,$name){

        if (!auth()->user()->isAdmin()) {
            throw new GeneralException('No tiene permiso para realizar esta acción');
        }

        return DB::transaction(function () use ($recipe_original,$name) {
            $recipe                 = new Recipe();
            $recipe->id             = null;
            $recipe->edit           = false;
            $recipe->name           = $name;
            $recipe->recipe_type_id = $recipe_original->recipe_type_id;
            $recipe->observation    = $recipe_original->observation;
            $recipe->save();

            foreach ($recipe_original->ingredients as $ingredient_original){
                $ingredient = new Ingredient();
                $ingredient->fill($ingredient_original->toArray());
                $ingredient->recipe_id    = $recipe->id;
                $ingredient->id           = null;
                $ingredient->save();
            }

            $classifications_ids = $recipe_original->classifications->pluck('id');

            $recipe->classifications()->attach($classifications_ids);

            return $recipe;
        });
    }
}
