<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserFormRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'name'     => ['required', 'string', 'max:65'],
                    'email'    => ['required', 'string', 'max:120', 'email', 'unique:users,email'],
                    'password' => [
                        'required', 'string', 'max:255',
                        Password::min(8)->mixedCase()->numbers()->symbols()
                    ],
                ];
            case 'PUT':
                return [
                    'name'     => ['nullable', 'string', 'max:65'],
                    'email'    => [
                        'nullable', 'string', 'max:120', 'email',
                        Rule::unique('users', 'email')->ignore($this->segment(3), 'id'),
                    ],
                    'password' => [
                        'nullable', 'string', 'max:255',
                        Password::min(8)->mixedCase()->numbers()->symbols()
                    ],
                ];
        }
    }
}
