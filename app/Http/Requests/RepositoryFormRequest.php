<?php

namespace App\Http\Requests;

class RepositoryFormRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'grade_level' => 'nullable|in:Aprendiz,Compañero,Maestro,Todos',
        ];

        // Add file validation for store requests
        if ($this->isMethod('post')) {
            $rules['document'] = 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,txt,jpg,jpeg,png|max:10240'; // 10MB max
        } else {
            // For update requests, file is optional
            $rules['document'] = 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,txt,jpg,jpeg,png|max:10240'; // 10MB max
        }

        return $rules;
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return array_merge(parent::messages(), [
            'document.required' => 'El archivo es obligatorio al crear un documento.',
            'document.file' => 'Debe seleccionar un archivo válido.',
            'document.mimes' => 'El archivo debe ser de tipo: pdf, doc, docx, ppt, pptx, xls, xlsx, txt, jpg, jpeg o png.',
            'document.max' => 'El archivo no puede pesar más de 10MB.',
            'grade_level.in' => 'El nivel de grado debe ser Aprendiz, Compañero, Maestro o Todos.',
        ]);
    }
}