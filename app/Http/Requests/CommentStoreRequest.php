<?php

namespace App\Http\Requests;

use App\Rules\NotSpamRule;
use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
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
            'message' => ['required', 'string', new NotSpamRule()],
            'message_id' => ['exists:messages,id', 'required_without:recording_id'],
            'recording_id' => ['exists:recordings,id', 'required_without:message_id'],
        ];
    }
}
