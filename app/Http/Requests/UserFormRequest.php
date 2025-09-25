<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserFormRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $userId = $this->route('user') ? $this->route('user')->id : null;
        
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
            'roles' => 'sometimes|array',
            'lodge_id' => 'nullable|exists:lodges,id',
        ];

        // Add password validation for store requests
        if ($this->isMethod('post')) {
            $rules['password'] = 'required|string|min:8';
        } else {
            // For update requests, password is optional
            $rules['password'] = 'nullable|string|min:8';
        }

        return $rules;
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return array_merge(parent::messages(), [
            'password.required' => 'La contraseña es obligatoria al crear un usuario.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'email.unique' => 'Ya existe un usuario con este correo electrónico.',
            'roles.array' => 'Los roles deben ser seleccionados de una lista.',
        ]);
    }
}