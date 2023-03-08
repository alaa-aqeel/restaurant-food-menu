<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuRequest extends FormRequest
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
        $menuId = $this->menu ? $this->menu :  auth()->user()?->menu?->id;

        return [
            "title" => "required|string|max:255",
            "address" => "required|string|max:255",
            "work_time" => "required|string|max:255",
            "image" => [
                "nullable",
                "image",
                "mimes:jpeg,png,jpg",
                "max:2048",
            ],
            "description" => "nullable",
            'phone_primary' => "nullable|min:11|max:15|unique:menus,phone_primary,".$menuId,
            'phone_secondary' =>  "nullable|min:11|max:15|unique:menus,phone_secondary,".$menuId,
            "facebook_page_id" => "nullable|unique:menus,facebook_page_id,".$menuId,
        ];
    }
}
