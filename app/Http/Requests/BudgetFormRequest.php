<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\PeriodType;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rules\Enum;

class BudgetFormRequest extends FormRequest
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
                    'account'     => [
                        'nullable', 'integer', 'gte:0',
                        Rule::exists('accounts', 'id')->where(function (Builder $query) {
                            return $query->where('deleted_at', null);
                        }),
                    ],
                    'name'        => ['required', 'string', 'max:65', 'unique:budgets,name',],
                    'amount'      => ['required', 'decimal:0,4', 'gte:0',],
                    'period'      => ['required', 'string', new Enum(PeriodType::class),],
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
                        'nullable', 'string',
                        Rule::unique('budgets', 'name')->ignore($this->segment(3), 'id'),
                    ],
                    'amount'      => ['nullable', 'decimal:0,4', 'gte:0',],
                    'period'      => ['nullable', 'string', new Enum(PeriodType::class),],
                    'observation' => ['nullable', 'string', 'max:512',],
                ];
        }
    }
}
