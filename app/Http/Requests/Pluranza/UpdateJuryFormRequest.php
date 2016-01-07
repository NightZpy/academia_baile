<?php

namespace App\Http\Requests\Pluranza;

use App\Http\Requests\Request;

class UpdateJuryFormRequest extends Request
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
            'ci' => 'required|numeric|digits_between:4,10',
            'gender' => 'in:m,f',
            'birth_date' => 'required',
            'email' => 'required|email|max:128|unique:jurors,email'.$this->id,
            'phone' => 'required|digits:11',
            'photo' => 'image|max:1024',
            'facebook' => 'url|max:128|unique:jurors,facebook,'.$this->id,
            'twitter' => 'url|max:128|unique:jurors,twitter,'.$this->id,
            'instagram' => 'url|max:128|unique:jurors,instagram,'.$this->id,
            'biography' => 'required|max:1024|min:64',
            'user_id' => 'required|exists:users,id',
            'category_id[]' => 'required|array'
        ];
    }
}