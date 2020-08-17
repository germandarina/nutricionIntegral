<?php

namespace App\Http\Requests\Backend\Admin\BasicInformation;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreBasicInformationRequest.
 */
class StoreBasicInformationRequest extends FormRequest
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
            'full_name'         => ['required'],
            'phone'             => ['required'],
            'cellphone'         => ['required'],
            'email'             => ['required'],
            'address'           => ['required'],
            'path_logo'         => ['required'],
            'path_imagen'       => ['required'],
            'm_professional'    => ['required'],
            'company_name'      => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => "El nombre es obligatorio.",
            'phone.required' => "El telefono es obligatorio.",
            'cellphone.required' => "El celular es obligatorio.",
            'email.required' => "El email es obligatorio.",
            'address.required' => "La dirección es obligatoria.",
            'path_logo.required' => "La imagen logo es obligatoria.",
            'path_imagen.required' => "La imagen es obligatoria.",
            'm_professional.required' => "La matricula profesional es obligatoria.",
            'company_name.required' => "El nombre de la empresa es obligatorio.",
        ];
    }
}
