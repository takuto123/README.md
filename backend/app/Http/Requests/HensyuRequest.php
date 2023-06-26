<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HensyuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'id' => 'required|integer',
            'name' => 'required|max:20',
            'kakaku' => 'required|integer',
            'kazu' => 'required|integer',
            'shosai' => 'required|max:100',
            'jyoukyou' => 'required'
        ];
    }
}
