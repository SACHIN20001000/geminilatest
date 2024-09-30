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
            'policy_no' => 'required',
            'policy_no_normal' => 'required',
            'holder_name' => 'required',
            'channel_name' => 'required',
            'mis_amount_paid' => 'required',
            'mis_premium_deposit' => 'required',
            'commission_base' => 'required',
            'mis_percentage' => 'required',
            'internal_percentage' => 'required',
        ];
    }
}
