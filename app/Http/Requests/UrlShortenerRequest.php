<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'urlName' => 'string',
        ];
    }

    public function messages()
    {
        return [
            'url.required' => 'The field :attribute is required',
            'url.string' => 'The field :attribute must be a string',
            'url.url' => 'The field :attribute must be correct url',
            'urlName.string' => 'The field :attribute must be a string',
        ];
    }
}
