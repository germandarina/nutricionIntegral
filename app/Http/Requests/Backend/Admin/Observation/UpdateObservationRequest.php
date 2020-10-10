<?php

namespace App\Http\Requests\Backend\Admin\Observation;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Session;

/**
 * Class UpdateObservationRequest.
 */
class UpdateObservationRequest extends FormRequest
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
            'name' => ['required', 'max:255','min:3'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "El nombre es obligatorio.",
            'name.min' => "El nombre debe tener, al menos, 3 caracteres.",
            'name.max' => "El nombre debe tener, maximo, 255 caracteres.",
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
