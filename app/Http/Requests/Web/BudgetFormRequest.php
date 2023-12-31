<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class BudgetFormRequest extends FormRequest
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
                    'account'     => [
                        'nullable', 'integer', 'gte:0',
                        Rule::exists('accounts', 'id')->where(function (Builder $query) {
                            return $query->where('deleted_at', null);
                        }),
                    ],
                    'name'        => ['required', 'string', 'max:65', 'unique:budgets,name',],
                    'amount'      => ['required', 'decimal:0,4', 'gt:0',],
                    'period'      => ['required', 'string', Rule::in([
                        'Diary', 'Weekly', 'Biweekly', 'Monthly', 'Annual'
                    ]),],
                    'observation' => ['nullable', 'string', 'max:512',],
                ];
            case 'PUT':
                return [
                    'account'     => [
                        'nullable', 'integer', 'gte:0',
                        Rule::exists('accounts', 'id')->where(function (Builder $query) {
                            return $query->where('deleted_at', null);
                        }),
                    ],
                    'name'        => [
                        'required', 'string',
                        Rule::unique('budgets', 'name')->ignore($this->segment(3), 'id'),
                    ],
                    'amount'      => ['nullable', 'decimal:0,4', 'gt:0',],
                    'period'      => ['nullable', 'string', Rule::in([
                        'Diary', 'Weekly', 'Biweekly', 'Monthly', 'Annual'
                    ]),],
                    'observation' => ['nullable', 'string', 'max:512',],
                ];
        }
    }
}
