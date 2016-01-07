<?php

namespace App\Http\Requests\Pluranza;

use App\Http\Requests\Request;

class UpdateAcademyRequest extends Request
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
            'name' => 'required|max:64|unique:academies,name,'.$this->id,
            'email' => 'max:128|unique:academies,email,,'.$this->id,
            'phone' => 'required|digits:11',
            'address' => 'min:5|max:256',
            'description' => 'min:20|max:1024',
            //'foundation' => 'date_format:d/m/Y',s
            'logo' => 'image',
            'facebook' => 'url|max:128|unique:academies,facebook,'.$this->id,
            'twitter' => 'url|max:128|unique:academies,twitter,'.$this->id,
            'instagram' => 'url|max:128|unique:academies,instagram,'.$this->id,
            'estate_id' => 'required|exists:estates,id',
            'municipality_id' => 'required|exists:municipalities,id',
            'parish_id' => 'exists:parishes,id',
            'city_id' => 'exists:cities,id'
        ];
    }
}