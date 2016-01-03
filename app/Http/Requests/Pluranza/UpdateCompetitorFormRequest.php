<?php

namespace App\Http\Requests\Pluranza;

use App\Http\Requests\Request;
use App\Pluranza\CompetitionType;

class UpdateCompetitorFormRequest extends Request
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
        $rules = [
            'academy_id' => 'required|integer|exists:academies,id|',//unique_with:competitors,name,'.$this->id,
            'name' => 'required|max:128',
            'song' => 'max:22528|mimes:mpga,mp2,mp2a,mp3,m2a,m3a',
            'song_name' => 'max:128|min:5',
            'competition_type_id' => 'required|integer|exists:competition_types,id',
            'category_id' => 'required|integer|exists:categories,id',
            'level_id' => 'required|integer|exists:levels,id',
            'dancer_id' => 'array|min:1'
        ];
        if ( strtolower(CompetitionType::findOrFail($this->request->get('competition_type_id'))->name) == 'pareja' ) {
            $rules['dancer_id.female']       = 'required|integer|exists:dancers,id';
            $rules['dancer_id.masculine']    = 'required|integer|exists:dancers,id';
        } else {
            foreach($this->request->get('dancer_id') as $key => $dancerId)
            {
                $rules['dancer_id.'.$key] = 'required|integer|exists:dancers,id';
            }
        }
        return $rules;
    }

    /*public function messages()
    {
        $messages = [];
        foreach($this->request->get('dancer_id') as $key => $dancerId)
        {
            $messages['dancer_id.'.$key.'.required'] = 'El bailarín '.$key.'" es .';
        }
        return $messages;
    }*/
}