<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZaikoRequest extends FormRequest
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
            'name' => 'required|max:20',
            'kakaku' => 'required|integer',
            'kazu' => 'required|integer',
            'shosai' => 'required|max:100',
            'jyoukyou' => 'required'
        ];
    }
}
