<?php

namespace App\Http\Requests;

class RegisterConfigurationFormRequest extends Request
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
            'max_competitors' => 'required|integer',
            'rules' => 'required|mimes:pdf|max:3000',
            'title' => 'required|max:64',
            'long_title' => 'required|max:128',
            'slogan' => 'required|max:128',
            'description' => 'required|max:1024',
        ];
    }
}