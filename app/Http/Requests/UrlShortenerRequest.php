<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UrlShortenerRequest extends FormRequest
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
            'url' => 'required|string|url',
            'name' => ['max:10', 'unique:urls,short_key', Rule::notIn(include "../app/Services/blacklist.php")],
            'date' => 'required|date|after:today',
        ];
    }

    public function messages()
    {
        return [
            'url.required' => 'The field :attribute is required',
            'url.string' => 'The field :attribute must be a string',
            'url.url' => 'The field :attribute must be correct url',
            'name.string' => 'The field :attribute must be a string',
            'name.unique' => ':attribute is already taken',
            'name.max' => 'Field length :attribute must not exceed 10 characters',
        ];
    }
}
