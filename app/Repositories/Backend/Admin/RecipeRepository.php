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
        // Make sure it doesn't already exist
//        if ($this->patientExists($data['document'])) {
//            Session::flash('error','Ya existe un receta con el documento '.$data['document']);
//            throw new GeneralException('Ya existe un receta con el documento '.$data['document']);
//        }
        return DB::transaction(function () use ($data) {
            $recipe = parent::create($data);

            if ($recipe) {
                $recipe->classifications()->attach($data['classifications']);
                return $recipe;
            }
            Session::flash('error','Error al crear receta. Intente nuevamente');
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
            Session::flash('error','No tiene permiso para realizar esta acción');
            throw new GeneralException('No tiene permiso para realizar esta acción');
        }

        // If the name is changing make sure it doesn't already exist
//        if ($recipe->document !== strtolower($data['document'])) {
//            if ($this->patientExists($data['document'])) {
//                Session::flash('error','Ya existe un receta con el documento '.$data['document']);
//                throw new GeneralException('Ya existe un receta con el documento '.$data['document']);
//            }
//        }

        return DB::transaction(function () use ($recipe, $data) {
            if (!$recipe->update($data)) {
                Session::flash('error','Error al actualizar receta. Intente nuevamente');
                throw new GeneralException('Error al actualizar receta. Intente nuevamente');
            }
            $recipe->classifications()->async($data['classifications']);
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
        if ($recipe->deleted_at === null) {
            Session::flash('error','El receta no esta eliminado');
            throw new GeneralException('El receta no esta eliminado');
        }
        if ($recipe->restore()) {
            return $recipe;
        }
        Session::flash('error','Error al restaurar receta. Intente nuevamente');
        throw new GeneralException('Error al restaurar receta. Intente nuevamente');
    }

    public function addIngredient(Recipe $recipe,$data){
        if (!auth()->user()->isAdmin()) {
            Session::flash('error','No tiene permiso para realizar esta acción');
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
}
