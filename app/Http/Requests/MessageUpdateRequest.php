<?php

namespace App\Http\Requests;

use App\Rules\NotSpamRule;
use App\Rules\ValidMessageTypeRule;
use Illuminate\Foundation\Http\FormRequest;

class MessageUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'type' => ['nullable', new ValidMessageTypeRule()],
            'sender' => ['nullable', 'string'],
            'receiver' => ['nullable', 'string'],
            'time' => ['nullable', 'date'],
            'message' => ['nullable', 'string', new NotSpamRule(), 'messageValidForType:type'],
        ];
    }
}
