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
            'phone' => ['required', 'max:15'],
            'email' => ['required', 'max:100','email','unique:employees'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "El nombre es obligatorio.",
            'phone.required' => "El telefono es obligatorio.",
            'email.required' => "El email es obligatorio.",
        ];
    }
}
