<?php

namespace App\Http\Requests\Validation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class VendoraddressSlotRequest extends FormRequest
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
            'parking_type' => 'required',
            'parking_no'=> 'required',
            // 'add_city_id '=> 'required',
            'starts_at'=> 'required',
            'ends_at'=> 'required',
            'parking_slots'=> 'required',
        


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
            'parking_type.required' => 'parking_type  is required',
            'parking_no.required' => 'parking_no  is required',
            
            'starts_at.required' => 'starts_at  is required',
            'ends_at.required' => 'ends_at  is required',
            'parking_slots.required' => 'parking_slots  is required',
           

           
        ];
    }
}
