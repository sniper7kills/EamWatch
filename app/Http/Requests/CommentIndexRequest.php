<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentIndexRequest extends FormRequest
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
            'paginate' => ['nullable', 'numeric'],
            'page' => ['nullable', 'numeric'],
            'message_id' => ['exists:messages,id', 'required_without:recording_id'],
            'recording_id' => ['exists:recordings,id', 'required_without:message_id'],
        ];
    }
}
