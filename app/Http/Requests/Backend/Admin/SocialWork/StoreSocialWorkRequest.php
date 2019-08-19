<?php

namespace App\Http\Requests\Backend\Admin\SocialWork;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreSocialWorkRequest.
 */
class StoreSocialWorkRequest extends FormRequest
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
            'name' => ['required', 'max:100','min:3'],
            'phone' => ['required', 'max:15','min:7'],
            'email' => ['required', 'max:100','min:10','email','unique:social_works'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "El nombre es obligatorio.",
            'name.min' => "El nombre debe tener, al menos, 3 caracteres.",
            'name.max' => "El nombre debe tener, maximo, 100 caracteres.",
            'phone.required' => "El telefono es obligatorio.",
            'phone.min' => "El telefono debe tener, al menos, 7 caracteres.",
            'phone.max' => "El telefono debe tener, maximo, 15 caracteres.",
            'email.unique' => "El email debe tener unico.",
            'email.required' => "El email es obligatorio.",
            'email.max' => "El email debe tener, maximo, 100 caracteres.",
            'email.min' => "El email debe tener, al menos, 10 caracteres.",
            'email.email' => "El email debe tener el formato de un correo electronico.",
        ];
    }
}
