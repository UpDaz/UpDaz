<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'lastname' => ['required', 'string'],
            'firstname' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'phone' => ['required', 'string'],
            'message' => ['required', 'string'],
        ];
    }
}
