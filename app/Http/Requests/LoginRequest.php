<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users',
            'password' => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'El email es requerido',
            'email.email' => 'El email no es valido',
            'email.exists' => 'No se puede encontrar el usuario en nuestros registros',
            'password.required' => 'La contraseña es requerida',
        ];
    }

    public function failedValidation(Validator $validator): HttpResponseException{
        throw new HttpResponseException(response()->json([
            'msg' => 'Validation errors',
            'success' => false,
            'data' => $validator->errors(),
            'exceptions' => 'validation',
        ], 400));
    }
}
