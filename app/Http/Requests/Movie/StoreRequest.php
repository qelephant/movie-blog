<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => ['required', 'string', 'between:2,255'],
            'description' => ['required', 'string', 'between:3,255'],
            'tagline' => ['required', 'string', 'between:3,255'],
            'year' => ['required', 'integer'],
            'budget' => ['required', 'integer'],
            'duration' => ['required', 'integer'],
            "country_id"    => "required|array|min:1",
            "country_id.*"  => "required|string|distinct",
            "composer_id"    => "required|array|min:1",
            "composer_id.*"  => "required|string|distinct",
            "director_id"    => "required|array|min:1",
            "director_id.*"  => "required|string|distinct",
            "actor_id"    => "required|array|min:1",
            "actor_id.*"  => "required|string|distinct"
        ];
    }
}
