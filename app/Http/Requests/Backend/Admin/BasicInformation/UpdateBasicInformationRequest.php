<?php

namespace App\Http\Requests\Backend\Admin\BasicInformation;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Session;

/**
 * Class StoreBasicInformationRequest.
 */
class UpdateBasicInformationRequest extends FormRequest
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
            'email'             => ['required'],
            'address'           => ['required'],
            'image'             => ['image','mimes:jpeg,jpg,png'],
//            'm_professional'    => ['string'],
            'company_name'      => ['required'],
            'frequency_days'    => ['required','integer']
        ];
    }

    public function messages()
    {
        return [
            'full_name.required'    => "El nombre es obligatorio.",
            'email.required'        => "El email es obligatorio.",
            'address.required'      => "La dirección es obligatoria.",
            'image.mimes'     => "El formato de la imagen debe ser: jpeg,jpg o png.",
//            'm_professional.required' => "La matricula profesional es obligatoria.",
            'company_name.required'   => "El nombre de la empresa es obligatorio.",
            'frequency_days.required' => 'La cantidad de días para el próximo turno es obligatorio',
            'frequency_days.integer'  => 'La cantidad de días para el próximo turno debe ser un numero'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->messages();
        $stringError = '';
        foreach ($errors as $error){
            $stringError .= "$error[0] | ";
        }

        Session::flash('validator', $stringError);
        parent::failedValidation($validator);
    }
}
