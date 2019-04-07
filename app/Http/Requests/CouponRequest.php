<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'start_time'=>'required',
            'end_time'=>'required',
            'code'=>'required|unique:coupons,code,'.$this->id,

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
            'code.required' => 'Code is required!',
            'start_time.required' => 'Start time is required!',
            'end_time.required' => 'End time is required!',
            'code.unique' => 'Code is unique!'
            
        ];
    }
}
