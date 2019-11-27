<?php

namespace App\Http\Requests\Backend\Admin\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateRoleRequest.
 */
class UpdatePatientRequest extends FormRequest
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
        $id = $this->request->get("id");
        return [
            'full_name' => ['required', 'max:200','min:6'],
            'birthdate' => ['required', 'date','before:tomorrow'],
            'age'=>['required','integer'],
            'motive'=>['required'],
            'number_of_children'=>['required','integer'],
            'document' => ['required','between:7,11',Rule::unique('patients')->ignore($id,'id')],
            'phone' => ['required', 'max:15','min:7'],
            'email' => ['max:100','email',Rule::unique('patients')->ignore($id,'id'),'min:10'],
            'address' => ['required', 'max:200','min:10'],
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => "El nombre y apellido es obligatorio.",
            'full_name.min' => "El nombre y apellido debe tener, al menos, 6 caracteres.",
            'full_name.max' => "El nombre y apellido debe tener, maximo, 200 caracteres.",
            'document.required' => "El documento es obligatorio.",
            'document.numeric' => "El documento debe ser un valor numerico.",
            'document.between' => "El documento debe tener, entre, 7 y 11 caracteres.",
            'document.unique' => "El documento ya esta en uso.",
            'phone.required' => "El telefono es obligatorio.",
            'phone.min' => "El telefono debe tener, al menos, 7 caracteres.",
            'phone.max' => "El telefono debe tener, maximo, 15 caracteres.",
            'email.required' => "El email es obligatorio.",
            'email.max' => "El email debe tener, maximo, 100 caracteres.",
            'email.min' => "El email debe tener, al menos, 10 caracteres.",
            'email.email' => "El email debe tener el formato de un correo electronico.",
            'email.unique' => "El email ya esta en uso.",
            'address.required' => "La direccion es obligatorio.",
            'address.max' => "La direccion debe tener, maximo, 200 caracteres.",
            'address.min' => "La direccion debe tener, al menos , 10 caracteres.",
            'birthdate.required'=>'La fecha de nacimiento es obligatoria',
            'birthdate.before'=>'La fecha de nacimiento no puede ser mayor a hoy',
            'age.required'=>'La edad es obligatoria',
            'age.integer'=>'La edad debe ser un numero entero',
            'motive.required'=>'El motivo es obligatorio',
            'number_of_children' =>'La cantidad de hijos es obligatoria',
        ];
    }
}
