<?php

namespace App\Http\Requests;

use App\Models\Lodge;

class LodgeFormRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $lodgeId = $this->route('lodge') ? $this->route('lodge')->id : null;
        
        $rules = [
            'name' => 'required|string|max:255',
            'number' => 'required|integer|unique:lodges,number,' . $lodgeId,
            'orient' => 'required|string|max:255',
            'history' => 'nullable|string',
            'image_url' => 'nullable|image|max:5120', // Validar como imagen, max 5MB
            'address' => 'nullable|string|max:500',
        ];

        return $rules;
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return array_merge(parent::messages(), [
            'number.unique' => 'Ya existe una logia con este número.',
            'number.integer' => 'El número de logia debe ser un valor numérico.',
            'image_url.image' => 'El campo imagen debe ser una imagen válida.',
            'image_url.max' => 'La imagen no puede pesar más de 5MB.',
        ]);
    }
}