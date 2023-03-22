<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentIndexRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'paginate' => ['nullable', 'numeric'],
            'page' => ['nullable', 'numeric'],
            'message_id' => ['exists:messages,id', 'required_without:recording_id'],
            'recording_id' => ['exists:recordings,id', 'required_without:message_id'],
        ];
    }
}
