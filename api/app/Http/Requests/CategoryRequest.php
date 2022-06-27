<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'POST':
                return [
                    "name" => "required|string|max:255",
                    "image" => "required|image"
                ];
            case "PUT":
                return [
                    "name" => "string|max:255",
                    "image" => "image"
                ];
        }
    }
}
