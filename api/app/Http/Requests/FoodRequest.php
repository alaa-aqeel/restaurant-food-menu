<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
            case "POST":
                return [
                    'name' => 'required|string|max:255',
                    'image' => 'required|image',
                    'price' => 'required|integer|min:0',
                    'is_available' => 'required|integer',
                    'description' => 'required|string|max:255',
                ];
            case 'PUT':
                return [
                    'name' => 'string|max:255',
                    'image' => 'image|max:255',
                    'price' => 'required|integer|min:0',
                    'is_available' => 'integer',
                    'description' => 'string|max:255',
                ];
        }
    }
}
