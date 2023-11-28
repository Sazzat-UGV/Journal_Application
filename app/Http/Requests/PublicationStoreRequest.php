<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicationStoreRequest extends FormRequest
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
            "paper_title" => "required|string|max:255",
            "author" => "required|string|max:255",
            "email" => "required|email|max:255",
            "doi" => "nullable|string|max:255",
            "abstract" => "required|string|max:5000",
            "paper_area" => "required|numeric",
            "publication_type" => "required|string",
            "image" => "nullable|mimes:png,jpg|max:10240",
            "file_upload" => "required|mimes:pdf,zip",
        ];
    }
}
