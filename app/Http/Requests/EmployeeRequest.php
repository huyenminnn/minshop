<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'email'=>'required|email|unique:employees, email,'.$this->id,
            'gender'=>'required',
            'address'=>'required',
            'mobile'=>'required',
            'salary'=>'required',
            'branch'=>'required',
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
            'email.required' => 'Email is required!',
            'email.unique' => 'Email is unique!',
            'gender.required' => 'Gender is required!',
            'address.required' => 'Address is required!',
            'mobile.required' => 'Mobile is required!',
            'salary.required' => 'Salary is required!',
            'branch.required' => 'Branch is required!',
        ];
    }
}
