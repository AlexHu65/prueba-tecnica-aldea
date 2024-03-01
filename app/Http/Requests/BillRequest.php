<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class BillRequest extends FormRequest
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
        return [
            'category_id' => 'required',
            'description' => 'required|string',
            'amount' => 'required',
            'date' => 'required'
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
