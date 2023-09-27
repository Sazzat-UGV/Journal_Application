<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailSettingRequest extends FormRequest
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
            "mail_mailer" => "required|string",
            "mail_host" => "required|string",
            "mail_port" => "required|string",
            "mail_username" => "required|string",
            "mail_password" => "required|string",
            "mail_encryption" => "required|string",
            "mail_from_address" => "required|string",
        ];
    }
}
