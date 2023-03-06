<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        return [
            "name" => [
                "required",
                Rule::unique('categories', 'name')->where(fn ($q) => $q->where('menu_id', auth()->user()->menu->id)),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => __(' الاسم مكرر يرجا اختيار اسم اخر '),
        ];
    }
}
