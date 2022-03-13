<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'title'        => 'required',
            'first_name'   => 'required',
            'last_name'    => 'required',
            'phone_number' => 'required',
            'gender'       => 'required',
            'image'        => 'required',
            'street'       => 'required',
            'city'         => 'required',
            'state'        => 'required',
            'country'      => 'required',
            'postcode'     => 'required',
            'email'        => 'required|email|unique:users,email'
        ];
    }
}
