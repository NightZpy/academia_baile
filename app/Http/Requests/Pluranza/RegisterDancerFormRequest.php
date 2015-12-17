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
            'ci' => 'required|max:16',
            'birth_date' => 'required',
            'email' => 'required|email|max:128|unique:dancers',
            'phone' => 'numeric',
            'photo' => 'image',
            'facebook' => 'max:128|unique:dancers',
            'twitter' => 'max:128|unique:dancers',
            'instagram' => 'max:128|unique:dancers',
            'independent' => 'in:off,on',
            'director' => 'in:off,on',
            'academy_id' => 'required|exists:academies_participants,id'
        ];
    }
}