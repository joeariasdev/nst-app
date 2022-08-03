<?php

namespace App\Http\Requests;

use App\Rules\StrengthPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user)],
            'password' => request()->route('user')
                ? ['max:50', new StrengthPassword]
                : ['required', 'max:50', new StrengthPassword],
            'role' => ['required', Rule::exists('roles', 'id')],
        ];
    }
}
