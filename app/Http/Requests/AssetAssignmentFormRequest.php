<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssetAssignmentFormRequest extends FormRequest
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
            'assignment_date' => 'required',
            'status' => 'required',
            'is_due' => 'required',
            'due_date' => 'required',
            'assigned_by' => 'required',
            'asset_id' => 'required'
        ];
    }
}
