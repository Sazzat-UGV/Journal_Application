<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $user=Auth::user()->id;
        return [
            "name" => "required|string|max:255",
            "email" => [
                'required',
                'email',
                Rule::unique('users')->ignore($user)
            ],
            "phone" =>"required|numeric",
            "address" => "required|string|max:255",
            "department_id" => "required|numeric",
            "semester_id" => 'required|numeric',
        ];
    }
}
