<?php

namespace App\Http\Requests\Composer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'between:2,255'],
            'last_name' => ['required', 'string', 'between:3,255'],
            'sex' => ['required', 'string'],
        ];
    }
}
