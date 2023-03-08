<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
                    'price' => 'required|integer|min:1',
                    'is_available' => 'integer',
                    'description' => 'nullable',
                    'category_id' => [
                        "required",
                        "integer",
                        'exists:categories,id',
                    ],
                ];
            case 'PUT':
                return [
                    'name' => 'required|string|max:255',
                    'image' => 'image',
                    'price' => 'required|integer|min:1',
                    'is_available' => 'integer',
                    'description' => 'nullable',
                    'category_id' => [
                        'required',
                        "integer",
                        'exists:categories,id',
                    ],
                ];
        }
    }

    public function messages()
    {
        return [
            'name.integer' => __('  يرجا ادخال السعر بشكل صحيح مع استخدام الاحرف الانكليزية'),
            'category_id.required' => __('يرجا اختيار التصنيف'),
            'category_id.integer' => __('يرجا اختيار التصنيف'),
        ];
    }
}
