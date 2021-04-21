<?php

namespace App\Http\Requests\Backend\Admin\Recipe;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Session;

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
            'recipe_type_id' => ['required'],
            'observation'=>['max:200'],
            'classifications' =>['required'],
            'portions' => ['required','integer','between:1,100']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "El nombre es obligatorio.",
            'name.min' => "El nombre debe tener, al menos, 6 caracteres.",
            'name.max' => "El nombre debe tener, maximo, 200 caracteres.",
            'recipe_type_id.required' => "Seleccione un tipo de receta.",
            'observation.min' => "La observacion debe tener, al menos, 6 caracteres.",
            'observation.max' => "La observacion debe tener, maximo, 200 caracteres.",
            'classifications.required' => 'Seleccione al menos 1 clasificación',
            'portions.required' => "La cantidad de porciones es obligatoria."
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->messages();
        $stringError = '';
        foreach ($errors as $error){
            $stringError .= "$error[0] |";
        }

        Session::flash('validator', $stringError);
        parent::failedValidation($validator);
    }
}
