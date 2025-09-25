<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

abstract class BaseFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Authorization should be handled in the controller or middleware
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }

    /**
     * Get the validation rules that apply to the request.
     */
    abstract public function rules();

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'unique' => 'El campo :attribute ya ha sido registrado.',
            'email' => 'El campo :attribute debe ser una dirección de correo válida.',
            'max' => 'El campo :attribute no puede tener más de :max caracteres.',
            'min' => 'El campo :attribute debe tener al menos :min caracteres.',
            'confirmed' => 'La confirmación de :attribute no coincide.',
            'numeric' => 'El campo :attribute debe ser un número.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'image' => 'El campo :attribute debe ser una imagen.',
            'file' => 'El campo :attribute debe ser un archivo.',
            'mimes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
            'size' => 'El campo :attribute debe tener un tamaño de :size kilobytes.',
            'max.file' => 'El archivo :attribute no puede pesar más de :max kilobytes.',
            'boolean' => 'El campo :attribute debe ser verdadero o falso.',
            'date' => 'El campo :attribute no es una fecha válida.',
            'in' => 'El valor seleccionado para :attribute no es válido.',
            'array' => 'El campo :attribute debe ser una lista.',
            'exists' => 'El valor seleccionado para :attribute no existe.',
            'string' => 'El campo :attribute debe ser una cadena de texto.',
        ];
    }
}