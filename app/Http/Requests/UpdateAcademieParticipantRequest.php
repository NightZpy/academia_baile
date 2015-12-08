<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateAcademieParticipantRequest extends Request
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
            'foundation' => 'date_format:d-m-Y',
            'logo' => 'image:jpg,png|mimes:jpg,png|max:128',
            'phone' => 'required|numeric',
            'facebook' => 'max:128|unique:academies_participants',
            'twitter' => 'max:128|unique:academies_participants',
            'instagram' => 'max:128|unique:academies_participants',
            'estate' => 'exists:estates,id_estado',
            'municipalities' => 'exists:municipalities,id_municipio',
            'parishes' => 'exists:parishes,id_parroquia',
            'cities' => 'exists:cities,id_ciudad'
        ];
    }
}