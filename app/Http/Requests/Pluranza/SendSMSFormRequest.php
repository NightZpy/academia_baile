<?php  

namespace App\Http\Requests\Pluranza;

use App\Http\Requests\Request;

class SendSMSFormRequest extends Request
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
            'custom' => 'require|in:all,custom,unverified',
            'academies' => 'required_if:type,custom',
            'message' => 'required|min:5|max:417'
        ];
    }
}