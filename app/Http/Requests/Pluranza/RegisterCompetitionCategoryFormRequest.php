<?php

namespace App\Http\Requests\Pluranza;

use App\Http\Requests\Request;

class RegisterCompetitionCategoryFormRequest extends Request
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
            'category_id' => 'required|unique_with:competition_categories,level_id,competition_type_id',
            'level_id' => 'required',
            'competition_type_id' => 'required'
        ];
    }
}