<?php

namespace App\Http\Requests\Backend\Admin\Classification;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreClassificationRequest.
 */
class StoreClassificationRequest extends FormRequest
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
            'name' => ['required', 'max:200','min:3'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "El nombre es obligatorio.",
            'name.min' => "El nombre debe tener, al menos, 6 caracteres.",
            'name.max' => "El nombre debe tener, maximo, 200 caracteres.",
        ];
    }
}
