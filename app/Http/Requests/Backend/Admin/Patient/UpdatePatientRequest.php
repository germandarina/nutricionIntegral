<?php

namespace App\Http\Requests\Backend\Admin\Patient;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'first_name' => ['required', 'max:100'],
            'last_name' => ['required', 'max:100'],
            'document' => ['required', 'max:11'],
            'phone' => ['required', 'max:15'],
            'email' => ['required', 'max:100'],
            'address' => ['required', 'max:200'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => "El nombre es obligatorio.",
            'last_name.required' => "El apellido es obligatorio.",
            'document.required' => "El documento es obligatorio.",
            'phone.required' => "El telefono es obligatorio.",
            'email.required' => "El email es obligatorio.",
            'address.required' => "El direccion es obligatorio.",
        ];
    }
}
