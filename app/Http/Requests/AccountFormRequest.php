<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;

class AccountFormRequest extends FormRequest
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
                    'bank'         => [
                        'required', 'integer',
                        Rule::exists('banks', 'id')->where(function (Builder $query) {
                            return $query->where('deleted_at', null);
                        }),
                    ],
                    'name'         => ['required', 'string', 'max:65',],
                    'observation'  => ['nullable', 'string', 'max:512',],
                ];
            case 'PUT':
                return [
                    'bank'         => [
                        'nullable', 'integer',
                        Rule::exists('banks', 'id')->where(function (Builder $query) {
                            return $query->where('deleted_at', null);
                        }),
                    ],
                    'name'         => ['nullable', 'string', 'max:65',],
                    'observation'  => ['nullable', 'string', 'max:512',],
                ];
        }
    }
}
