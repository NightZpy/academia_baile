<?php

namespace App\Http\Requests\Pluranza;

use App\Http\Requests\Request;

class RegisterExhibitionFormRequest extends Request
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
            'academy_id' => 'required|integer|exists:academies,id|unique_with:exhibitions,name',
            'name' => 'required|max:128',
            'song' => 'max:22528|mimes:mpga,mp2,mp2a,mp3,m2a,m3a',
            'song_name' => 'max:128|min:5',
            'dancer_id' => 'required|array|min:1',
            'gender_id' => 'required|array|min:1',
        ];
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