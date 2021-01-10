<?php

namespace App\Http\Requests;

use App\Rules\NotSpamRule;
use App\Rules\ValidMessageTypeRule;
use Illuminate\Foundation\Http\FormRequest;

class MessageStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => ['required', new ValidMessageTypeRule()],
            'sender' => ['required', 'string'],
            'receiver' => ['string', 'nullable'],
            'time' => ['required', 'date'],
            'message' => ['required', 'string', new NotSpamRule(), 'messageValidForType:type']
        ];
    }
}
