<?php

namespace App\Http\Requests\Admin\Policy;

use Illuminate\Foundation\Http\FormRequest;

class PolicyRequest extends FormRequest
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
            'policy_no' => 'policy_no|unique:policies',
            'policy_no_normal' => 'policy_no|unique:policies',
        ];
    }
}
