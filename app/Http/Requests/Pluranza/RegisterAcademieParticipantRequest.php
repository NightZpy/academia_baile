<?php

namespace App\Http\Requests\Pluranza;

use App\Http\Requests\Request;

class RegisterAcademieParticipantRequest extends Request
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
            'name' => 'required|max:64|unique:academies_participants',
            'email' => 'required|email|max:128|confirmed|unique:academies_participants',
            'email_confirmation' => 'required|email|max:128',
            'phone' => 'required|numeric|confirmed',
            'phone_confirmation' => 'required|numeric',
            'password' => 'required|confirmed'
        ];
    }
}