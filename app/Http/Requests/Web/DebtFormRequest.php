<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;

class DebtFormRequest extends FormRequest
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
                    'category'     => [
                        'nullable', 'integer', 'gte:0',
                        Rule::exists('categories', 'id')->where(function (Builder $query) {
                            return $query->where('deleted_at', null);
                        }),
                    ],
                    'name'         => ['required', 'string', 'max:65', 'unique:debts,name',],
                    'amount'       => ['required', 'decimal:0,4', 'gte:0',],
                    'period'       => ['required', 'string', Rule::in([
                        'Diary', 'Weekly', 'Biweekly', 'Monthly', 'Annual'
                    ])],
                    'day'          => ['nullable', 'integer', 'gte:0',],
                    'date_at'      => ['nullable', 'date',],
                    'observation'  => ['nullable', 'string', 'max:512',],
                ];
            case 'PUT':
                return [
                    'category'     => [
                        'nullable', 'integer', 'gte:0',
                        Rule::exists('categories', 'id')->where(function (Builder $query) {
                            return $query->where('deleted_at', null);
                        }),
                    ],
                    'name'         => [
                        'required', 'string', 'max:65',
                        Rule::unique('debts', 'name')->ignore($this->segment(3), 'id'),
                    ],
                    'amount'       => ['required', 'decimal:0,4', 'gte:0',],
                    'period'       => ['required', 'string', Rule::in([
                        'Diary', 'Weekly', 'Biweekly', 'Monthly', 'Annual'
                    ])],
                    'day'          => ['nullable', 'integer', 'gte:0',],
                    'date_at'      => ['nullable', 'date',],
                    'observation'  => ['nullable', 'string', 'max:512',],
                ];
        }
    }
}
