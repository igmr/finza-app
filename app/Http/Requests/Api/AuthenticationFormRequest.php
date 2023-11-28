<?php

namespace App\Http\Requests\Api;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticationFormRequest extends FormRequest
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
                    'email'    => ['required', 'string', 'max:120', 'email',
                    function (string $attribute, mixed $value, Closure $fail) {
                        $user = User::where('email', 'like', $value)->first();
                        if (!isset($user)) {
                            $fail("The {$attribute} is invalid.");
                        }
                    },],
                    'password' => [
                        'required', 'string', 'max:255',
                        Password::min(8)->mixedCase()->numbers()->symbols(),
                        function (string $attribute, mixed $value, Closure $fail) {
                            $user = User::where('email', 'like', $this->email)->first();
                            if (isset($user)) {
                                $dbPassword = $user->password;
                                if(!Hash::check($value, $dbPassword))
                                {
                                    $fail("The {$attribute} is invalid.");
                                }
                            }
                        }
                    ],
                ];
        }
    }
}
