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
            'observation'=>['required','integer'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "El nombre y apellido es obligatorio.",
            'name.min' => "El nombre y apellido debe tener, al menos, 6 caracteres.",
            'name.max' => "El nombre y apellido debe tener, maximo, 200 caracteres.",
            'recipe_type_id.required' => "El documento es obligatorio.",
            'recipe_type_id.between' => "El documento debe tener, entre, 7 y 11 caracteres.",
            'observation.required' => "El telefono es obligatorio.",
        ];
    }
}
