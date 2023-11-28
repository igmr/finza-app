<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClassificationFormRequest extends FormRequest
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
        switch($this->method())
        {
            case 'POST':
                return [
                    'code'        => ['nullable', 'string', 'max:10',],
                    'name'        => ['required', 'string', 'max:255', 'unique:classifications,name'],
                    'icon'        => ['nullable', 'string', 'max:15',],
                    'observation' => ['nullable', 'string', 'max:512',],
                ];
            case 'PUT':
                return [
                    'code'        => ['nullable', 'string', 'max:10',],
                    'name'        => [
                        'nullable', 'string', 'max:255',
                        Rule::unique('classifications', 'name')->ignore($this->segment(3), 'id'),
                    ],
                    'icon'        => ['nullable', 'string', 'max:15',],
                    'observation' => ['nullable', 'string', 'max:512',],
                ];
        }
    }
}
