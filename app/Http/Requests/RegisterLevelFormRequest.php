<?php

namespace App\Http\Requests;

class RegisterLevelFormRequest extends Request
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
            'name' => 'required|max:128|unique:levels',
            'description' => 'max:512',
            'photo' => 'image',
        ];
    }
}