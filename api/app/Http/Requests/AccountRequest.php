<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AccountRequest extends FormRequest
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
            "name" => "required",
            "username" => "required|min:2|unique:users,username,".auth()->id() ,
            "phone" => "nullable|min:11|max:15|unique:users,phone,".auth()->id(),
            "password" => ['nullable', Password::min(8)->uncompromised()],
        ];
    }
}
