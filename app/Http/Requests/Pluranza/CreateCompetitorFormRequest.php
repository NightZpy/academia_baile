<?php

namespace App\Http\Requests\Pluranza;

use App\Http\Requests\Request;

class CreateCompetitorFormRequest extends Request
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
            'academy_id' => 'required|integer|exists:academies,id',
            'competition_type_id' => 'required|integer|exists:competition_types,id'
        ];
    }
}