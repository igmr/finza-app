<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class EgressFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
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
                    'category'    => [
                        'required', 'integer', 'gte:0',
                        Rule::exists('categories', 'id')->where(function (Builder $query) {
                            return $query->where('deleted_at', null);
                        }),
                    ],
                    'saving'      => [
                        'nullable', 'integer', 'gte:0',
                        Rule::exists('savings', 'id')->where(function (Builder $query) {
                            return $query->where('deleted_at', null);
                        }),
                    ],
                    'debt'        => [
                        'nullable', 'integer', 'gte:0',
                        Rule::exists('debts', 'id')->where(function (Builder $query) {
                            return $query->where('deleted_at', null);
                        }),
                    ],
                    'account'     => [
                        'required', 'integer', 'gte:0',
                        Rule::exists('accounts', 'id')->where(function (Builder $query) {
                            return $query->where('deleted_at', null);
                        }),
                    ],
                    'concept'     => ['required', 'string', 'max:255',],
                    'description' => ['nullable', 'string', 'max:255',],
                    'reference'   => ['nullable', 'string', 'max:255',],
                    'amount'      => ['required', 'decimal:0,4',],
                    'observation' => ['nullable', 'string', 'max:512',],
                ];
            case 'PUT':
                return [
                    'category'    => [
                        'required', 'integer', 'gte:0',
                        Rule::exists('categories', 'id')->where(function (Builder $query) {
                            return $query->where('deleted_at', null);
                        }),
                    ],
                    'saving'      => [
                        'nullable', 'integer', 'gte:0',
                        Rule::exists('savings', 'id')->where(function (Builder $query) {
                            return $query->where('deleted_at', null);
                        }),
                    ],
                    'debt'        => [
                        'nullable', 'integer', 'gte:0',
                        Rule::exists('debts', 'id')->where(function (Builder $query) {
                            return $query->where('deleted_at', null);
                        }),
                    ],
                    'account'     => [
                        'nullable', 'integer', 'gte:0',
                        Rule::exists('accounts', 'id')->where(function (Builder $query) {
                            return $query->where('deleted_at', null);
                        }),
                    ],
                    'concept'     => ['required', 'string', 'max:255',],
                    'description' => ['nullable', 'string', 'max:255',],
                    'reference'   => ['nullable', 'string', 'max:255',],
                    'amount'      => ['required', 'decimal:0,4',],
                    'observation' => ['nullable', 'string', 'max:512',],
                ];
        }
    }
}
