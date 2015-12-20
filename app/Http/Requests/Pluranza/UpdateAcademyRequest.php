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
            'address' => 'max:256',
            'description' => 'max:1024',
            //'foundation' => 'date_format:d/m/Y',
            'logo' => 'image',
            'phone' => 'required|numeric',
            'facebook' => 'max:128|unique:academies,facebook,'.$this->id,
            'twitter' => 'max:128|unique:academies,twitter,'.$this->id,
            'instagram' => 'max:128|unique:academies,instagram,'.$this->id,
            'estate' => 'exists:estates,id_estado',
            'municipalities' => 'exists:municipalities,id_municipio',
            'parishes' => 'exists:parishes,id_parroquia',
            'cities' => 'exists:cities,id_ciudad'
        ];
    }
}