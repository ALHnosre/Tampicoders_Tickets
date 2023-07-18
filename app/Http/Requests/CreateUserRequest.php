<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [

            'name'             => 'required|alpha:ascii',
            'last_name'        => 'required',
            'phone_number'     => 'required',
            'email'            => 'required|unique:App\Models\User,email',
            'confirm_email'    => 'required|same:email',
            'password'         => 'required',
            'confirm_password' => 'required|same:password',

        ];
    }

    public function messages(): array
    {
        return[

            'name.alpha:ascii'      => 'El nombre del usuario solo acepta caracteres de la A-Z',
            'name.required'         =>  'El nombre del usuario es obligatorio',
            'confirm_Email.same'    => 'Los email no coinciden'

        ];
    }
}
