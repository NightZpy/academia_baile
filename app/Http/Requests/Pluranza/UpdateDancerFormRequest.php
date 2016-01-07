<?php

namespace App\Http\Requests\Pluranza;

use App\Http\Requests\Request;

class UpdateDancerFormRequest extends Request
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
            'email' => 'required|email|max:128|unique:dancers,email,'.$this->id,
            'phone' => 'digits:11',
            'photo' => 'image|max:1024',
            'facebook' => 'url|max:128|unique:dancers,facebook,'.$this->id,
            'twitter' => 'url|max:128|unique:dancers,twitter,'.$this->id,
            'instagram' => 'url|max:128|unique:dancers,instagram,'.$this->id,
            'independent' => 'in:off,on',
            'director' => 'in:off,on',
            'biography' => 'max:1024|min:64',
            'academy_id' => 'required|exists:academies,id'
        ];
    }
}