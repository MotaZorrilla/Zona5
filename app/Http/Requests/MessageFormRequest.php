<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class MessageFormRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'recipient_id' => 'required|exists:users,id|different:' . Auth::id(),
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return array_merge(parent::messages(), [
            'recipient_id.different' => 'No puedes enviarte un mensaje a ti mismo.',
        ]);
    }
}