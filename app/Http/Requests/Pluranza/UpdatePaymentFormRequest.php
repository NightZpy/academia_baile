<?php

namespace App\Http\Requests\Pluranza;

use App\Http\Requests\Request;

class UpdatePaymentFormRequest extends Request
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
            'amount' => 'required|integer',
            'reference_code' => 'max:128|min:2|alpha_num|unique:payments,reference_code,' . $this->id,
            'pay_date' => 'required|date',
            'voucher' => 'image',
            'competitor_id' => 'exists:competitors,id'
        ];
    }
}