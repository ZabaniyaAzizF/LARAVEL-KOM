<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'                  => 'required|min:3',
            'telepon'               => 'nullable|min:10',
            'alamat'                => 'nullable|max:255',
            'email'                 => 'required|email|unique:users,email',
            'role'                  => 'required',
            'password'              => 'required|min:8|confirmed',
        ];
    }
}
