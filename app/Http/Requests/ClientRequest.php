<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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
            'identification' => ['required', 'max:150', Rule::unique('clients', 'identification')->ignore($this->client)],
            'name' => ['required', 'max:100'],
            'address' => ['required', 'max:100'],
            'phone_number' => ['required', 'numeric', 'min:10'],
            'email' => ['required', 'email', 'max:100'],
        ];
    }
}
