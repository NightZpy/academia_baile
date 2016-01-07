<?php

namespace App\Http\Requests\Pluranza;

use App\Http\Requests\Request;

class RegisterDancerFormRequest extends Request
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
            'name' => 'required|max:128',
            'last_name' => 'required|max:128',
            'ci' => 'required|numeric|digits_between:4,16',
            'gender' => 'in:m,f',
            'birth_date' => 'required',
            'email' => 'required|email|max:128|unique:dancers',
            'phone' => 'digits:11',
            'photo' => 'image|max:1024',
            'facebook' => 'url|max:128|unique:dancers',
            'twitter' => 'url|max:128|unique:dancers',
            'instagram' => 'url|max:128|unique:dancers',
            'independent' => 'in:off,on',
            'director' => 'in:off,on',
            'biography' => 'max:1024|min:64',
            'academy_id' => 'required|exists:academies,id'
        ];
    }
}