<?php

namespace App\Http\Requests;

class NewsFormRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published,scheduled',
            'published_at' => 'nullable|date',
        ];

        // Add image and pdf validation
        $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'; // 2MB max
        $rules['pdf'] = 'nullable|file|mimes:pdf|max:5120'; // 5MB max

        return $rules;
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return array_merge(parent::messages(), [
            'image.image' => 'El campo imagen debe ser una imagen válida.',
            'image.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o gif.',
            'image.max' => 'La imagen no puede pesar más de 2MB.',
            'pdf.file' => 'El campo PDF debe ser un archivo válido.',
            'pdf.mimes' => 'El archivo debe ser de tipo PDF.',
            'pdf.max' => 'El archivo PDF no puede pesar más de 5MB.',
            'status.in' => 'El estado debe ser borrador, publicado o programado.',
            'published_at.date' => 'La fecha de publicación debe ser una fecha válida.',
        ]);
    }
}