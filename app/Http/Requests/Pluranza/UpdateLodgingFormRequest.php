<?php

namespace App\Http\Requests\Pluranza;

use App\Http\Requests\Request;

class UpdateLodgingFormRequest extends Request
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
            'name' => 'required|max:128|unique:lodgings,name,' . $this->id,
            'phones' => 'required|max:128',
            'web' => 'url|max:256',
            'description' => 'max:512',
        ];
    }
}