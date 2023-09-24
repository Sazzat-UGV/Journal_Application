<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|max:255",
            "student_id" => "required|numeric|min:4|unique:users",
            "email" => "required|email|max:255|unique:users",
            "phone" => "required|numeric|min:11|unique:users",
            "address" => "required|string|max:255",
            "department_id" => "required|numeric",
            "semester_id" => "required|numeric",
            "password" => "required|string|confirmed",
        ];
    }
}
