<?php

namespace App\Http\Requests\Backend\Admin\Recipe;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateRoleRequest.
 */
class UpdateRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:200','min:6'],
            'recipe_type_id' => ['required', 'date','before:tomorrow'],
            'observation'=>['max:200','min:6'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "El nombre es obligatorio.",
            'name.min' => "El nombre debe tener, al menos, 6 caracteres.",
            'name.max' => "El nombre debe tener, maximo, 200 caracteres.",
            'recipe_type_id.required' => "El tipo de receta es obligatorio.",
            'observation.min' => "La observacion debe tener, al menos, 6 caracteres.",
            'observation.max' => "La observacion debe tener, maximo, 200 caracteres.",
        ];
    }
}
