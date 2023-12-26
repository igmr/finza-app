<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;

class AccountFormRequest extends FormRequest
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
                    'bank'         => [
                        'required', 'integer',
                        Rule::exists('banks', 'id')->where(function (Builder $query) {
                            return $query->where('deleted_at', null);
                        }),
                    ],
                    'name'         => ['required', 'string', 'max:65', 'unique:accounts,name'],
                    'observation'  => ['nullable', 'string', 'max:512',],
                ];
            case 'PUT':
                return [
                    'bank'         => [
                        'required', 'integer',
                        Rule::exists('banks', 'id')->where(function (Builder $query) {
                            return $query->where('deleted_at', null);
                        }),
                    ],
                    'name'         => [
                        'required', 'string', 'max:65',
                        Rule::unique('accounts', 'name')->ignore($this->segment(3), 'id'),
                    ],
                    'observation'  => ['nullable', 'string', 'max:512',],
                ];
        }
    }
}
