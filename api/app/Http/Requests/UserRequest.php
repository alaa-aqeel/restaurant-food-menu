<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        switch($this->method()){
            case 'POST':
                return [
                    "name" => "required",
                    "username" => "required|min:2|unique:users,username,".$this->user,
                    "phone" => "nullable|min:11|max:15|unique:users,phone,".$this->user,
                    "expire_at" => "nullable|date",
                    "is_admin" => "integer",
                    "password" => ['required', Password::min(8)->uncompromised()],
                ];

            case 'PUT':
                return [
                    "name" => "string",
                    "username" => "min:2|unique:users,username,".$this->user,
                    "phone" => "nullable|min:11|max:15|unique:users,phone,".$this->user,
                    "expire_at" => "nullable|date",
                    "is_admin" => "integer",
                    "password" => ["nullable", Password::min(8)->uncompromised()],
                ];
        }
    }
}
