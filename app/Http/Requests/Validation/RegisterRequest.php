<?php

namespace App\Http\Requests\Validation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;



class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|string|unique:users,email',
            'phonenumber'=> 'required|numeric|min:10|unique:users',
            'password' => 'required|string|min:8|regex:/[A-Z]/|regex:/[0-9]/',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
    public function messages() //OPTIONAL
    {
        return [
            'email.required' => 'Email is required',
            'password.required' => 'password is required',
            'name.required' => 'Name is required',
            'phonenumber.required' => 'Phonenumber is required',



            'email.email' => 'Email is not correct',
            'password.password' => 'password is not correct',
            'name.name' => 'Name is not correct',
            'phonenumber.phonenumber' => 'Phone Number is not correct',



        ];
    }
}
