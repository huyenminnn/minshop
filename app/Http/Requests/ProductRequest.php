<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_code'=>'required|unique:products,slug,'.$this->id,
            'category_id'=>'required',
            'slug'=>'required|unique:products,slug,'.$this->id,
            'brand'=>'required',
            'price'=>'required',
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
            'name.required' => 'Name is required!',
            'category_id.required' => 'Category is required!',
            'product_code.required' => 'Product code is required!',
            'slug.required' => 'Slug is required!',
            'brand.required' => 'Brand is required!',
            'price.required' => 'Price is required!',
            'product_code.unique' => 'Product code is unique!',
            'slug.unique' => 'Slug is unique!',
            
        ];
    }
}
