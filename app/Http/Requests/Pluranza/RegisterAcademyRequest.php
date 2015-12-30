<?php

namespace App\Http\Requests\Pluranza;

use App\Http\Requests\Request;

class RegisterAcademyRequest extends Request
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
            'name' => 'required|max:64|unique:academies',
            'email' => 'required|email|max:128|confirmed|unique:academies',
            'email_confirmation' => 'required|email|max:128',
            'phone' => 'required|numeric',
            'password' => 'required|confirmed|min:6'
        ];
    }
}