<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductDetailRequest extends FormRequest
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
            'size'=>'required|unique:product_details,size,'.$this->id.',id,color_id,'.$this->color_id,
            'color_id'=>'required',
            'quantity'=>'required',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'color_id.required' => 'Color is required!',
            'quantity.required' => 'Quantity is required!',
            'size.unique' => 'Size is unique!'
            // 'color_id.unique' => 'Color is unique!'
        ];
    }
}
