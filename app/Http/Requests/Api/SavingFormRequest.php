<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SavingFormRequest extends FormRequest
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
                    'name'         => ['required', 'string', 'max:65', 'unique:savings,name'],
                    'amount'       => ['required', 'decimal:0,4', 'gte:0'],
                    'finish'       => ['required', 'date'],
                    'observation'  => ['nullable', 'string', 'max:512'],
                ];
            case 'PUT':
                return [
                    'name'         => [
                        'nullable', 'string', 'max:65',
                        Rule::unique('savings', 'name')->ignore($this->segment(3), 'id'),
                    ],
                    'amount'       => ['nullable', 'decimal:0,4', 'gte:0'],
                    'finish'       => ['nullable', 'date'],
                    'observation'  => ['nullable', 'string', 'max:512'],
                ];
        }
    }
}
