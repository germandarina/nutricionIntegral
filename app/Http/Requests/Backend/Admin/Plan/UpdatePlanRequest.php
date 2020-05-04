<?php

namespace App\Http\Requests\Backend\Admin\Plan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdatePlanRequest.
 */
class UpdatePlanRequest extends FormRequest
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
            'patient_id' => ['required'], // agregar validacion de si existe en la tabla food_group
            'days' =>['required','numeric']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "El nombre es obligatorio.",
            'name.min' => "El nombre debe tener, al menos, 6 caracteres.",
            'name.max' => "El nombre debe tener, maximo, 200 caracteres.",
            'patient_id.required'=>'El grupo de alimentos es obligatorio',
            'days.required' =>'La cantidad de días es requerida',
            'days.numeric' => 'Debe ingresar el número de días',
        ];
    }
}
