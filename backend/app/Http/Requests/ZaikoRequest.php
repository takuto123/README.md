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
        $rules = [
            'name' => 'required|max:20',
            'kakaku' => 'required|integer',
            'kazu' => 'required|integer',
            'shosai' => 'required|max:100',
            'jyoukyou' => 'required'
        ];

        // PUT や PATCH メソッドの場合のみ id フィールドをバリデーションする
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['id'] = 'required|integer';
        }

        return $rules;
    }

}
