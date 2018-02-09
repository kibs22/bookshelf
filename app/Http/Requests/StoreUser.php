<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
class StoreUser extends FormRequest
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
        $rules =  [
            'firstname' => 'required',
            'MI'        => 'max:1',
            'lastname'  => 'required',
            'address'   => 'required',
            'mobile'    => 'required|numeric',
            'password'  => 'required|min:8|max:12|confirmed',
            'email'     => 'required|unique:users',
            'image'     => 'required|image'
        ];

        return $rules;
    }
  
}
