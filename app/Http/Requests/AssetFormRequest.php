<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssetFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required',
            'serial_number'=> 'required',
            'description' => 'required',
            'motion' => 'required',
            'picture_path' => 'required',
            'purchase_date' => 'required'
            'start_use_date' => 'required',
            'purchase_price' => 'required',
            'warranty_expiry_date' => 'required',
            'purchase_date' => 'required',
            'degradation' => 'required',
            'current_value' => 'required',
            'location' => 'required',

        ];
    }
}
