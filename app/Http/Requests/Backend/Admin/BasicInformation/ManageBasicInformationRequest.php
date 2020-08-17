<?php

namespace App\Http\Requests\Backend\Admin\BasicInformation;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ManageBasicInformationRequest.
 */
class ManageBasicInformationRequest extends FormRequest
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
            //
        ];
    }
}
