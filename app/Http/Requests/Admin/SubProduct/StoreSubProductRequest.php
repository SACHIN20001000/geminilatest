<?php

namespace App\Http\Requests\Admin\SubProduct;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubProductRequest extends FormRequest
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
            'name'=>'required',
            'insurance_id'=>'required',
            'product_id'=>'required',
        ];
    }
}
