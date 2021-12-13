<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Authenicate_register extends FormRequest
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
            'first_name' => 'required|string',
            'middle_name' => 'min:4',
            'last_name' => 'required|string',
            'email' => 'required|email|',
            'phone_number' => 'required|numeric',
            'picture_url' => 'required',
            'password' => 'required',
            'is_disabled' => 'required',
        ];
    }
}
