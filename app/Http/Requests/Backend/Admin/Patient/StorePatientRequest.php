<?php

namespace App\Http\Requests\Backend\Admin\Patient;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Session;

/**
 * Class StoreRoleRequest.
 */
class StorePatientRequest extends FormRequest
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
            'full_name'          => ['required', 'max:200','min:6'],
            'birthdate'          => ['required', 'date_format:d/m/Y','before:tomorrow'],
            'age'                => ['required','integer'],
            'motive'             => ['required'],
            'number_of_children' => ['integer'],
            'document'           => ['between:7,11','unique:patients'],
            'phone'              => [ 'max:15','min:7'],
            'email'              => ['max:100','email','unique:patients'],
            'address'            => [ 'max:200'],
            'gender'             => ['required']
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => "El nombre y apellido es obligatorio.",
            'full_name.min' => "El nombre y apellido debe tener, al menos, 6 caracteres.",
            'full_name.max' => "El nombre y apellido debe tener, maximo, 200 caracteres.",
            'document.required' => "El documento es obligatorio.",
            'document.between' => "El documento debe tener, entre, 7 y 11 caracteres.",
            'phone.required' => "El telefono es obligatorio.",
            'phone.min' => "El telefono debe tener, al menos, 7 caracteres.",
            'phone.max' => "El telefono debe tener, maximo, 15 caracteres.",
            'email.required' => "El email es obligatorio.",
            'email.max' => "El email debe tener, maximo, 100 caracteres.",
            'email.email' => "El email debe tener el formato de un correo electronico.",
            'email.unique' => "El email debe tener unico.",
            'address.required' => "La direccion es obligatorio.",
            'address.max' => "La direccion debe tener, maximo, 200 caracteres.",
            'birthdate.required'=>'La fecha de nacimiento es obligatoria',
            'birthdate.before'=>'La fecha de nacimiento no puede ser mayor a hoy',
            'age.required'=>'La edad es obligatoria',
            'age.integer'=>'La edad debe ser un numero entero',
            'motive.required'=>'El motivo es obligatorio',
            'gender.required' => 'El Sexo / Género es obligatorio',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->messages();
        $stringError = '';
        foreach ($errors as $error){
            $stringError .= "$error[0] ,";
        }

        Session::flash('validator', $stringError);
        parent::failedValidation($validator);
    }
}
