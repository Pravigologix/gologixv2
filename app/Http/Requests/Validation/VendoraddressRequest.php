<?php

namespace App\Http\Requests\Validation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class VendoraddressRequest extends FormRequest
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
            'add_description' => 'required',
            'add_address'=> 'required',
            // 'add_city_id '=> 'required',
            'add_latitude'=> 'required',
            'add_longitude'=> 'required',
            'add_isactive'=> 'required',
            'add_isdeleted'=> 'required',
'add_pincode'=>'required'


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
            'add_description.required' => 'address description is required',
            'add_address.required' => 'address  is required',
            
            'add_latitude.required' => 'address latitude is required',
            'add_longitude.required' => 'address longitude is required',
            'add_isactive.required' => 'add_isactive  is required',
            'add_isdeleted.required' => 'add_isdeleted  is required',
            'add_pincode.required'=>'pincode is required'

           
        ];
    }
}
