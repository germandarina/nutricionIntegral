<?php

namespace App\Http\Requests\Backend\Admin\Employee;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRoleRequest.
 */
class UpdateEmployeeRequest extends FormRequest
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
            'first_name' => ['required', 'max:100','min:3'],
            'last_name' => ['required', 'max:100','min:3'],
            'document' => ['required', 'max:11','min:7','numeric'],
            'phone' => ['required', 'max:15','min:7'],
            'email' => ['required', 'max:100','email','min:10'],
            'address' => ['required', 'max:200','min:10'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => "El nombre es obligatorio.",
            'first_name.min' => "El nombre debe tener, al menos, 3 caracteres.",
            'first_name.max' => "El nombre debe tener, maximo, 100 caracteres.",
            'last_name.required' => "El apellido es obligatorio.",
            'last_name.min' => "El apellido debe tener, al menos, 3 caracteres.",
            'last_name.max' => "El apellido debe tener, maximo, 100 caracteres.",
            'document.required' => "El documento es obligatorio.",
            'document.numeric' => "El documento debe ser un valor numerico.",
            'document.min' => "El documento debe tener, al menos, 7 caracteres.",
            'document.max' => "El documento debe tener, maximo, 11 caracteres.",
            'phone.required' => "El telefono es obligatorio.",
            'phone.min' => "El telefono debe tener, al menos, 7 caracteres.",
            'phone.max' => "El telefono debe tener, maximo, 15 caracteres.",
            'email.required' => "El email es obligatorio.",
            'email.max' => "El email debe tener, maximo, 100 caracteres.",
            'email.min' => "El email debe tener, al menos, 10 caracteres.",
            'email.email' => "El email debe tener el formato de un correo electronico.",
            'address.required' => "La direccion es obligatorio.",
            'address.max' => "La direccion debe tener, maximo, 200 caracteres.",
            'address.min' => "La direccion debe tener, al menos , 10 caracteres.",
        ];
    }
}
