<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordingStoreRequest extends FormRequest
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
            'uuid' => ['required_without:file'],
            'key' => ['required_without:file'],
            'bucket' => ['required_without:file'],
            'name' => ['required_without:file'],
            'content_type' => ['required_without:file'],
            'recording' => ['required_without:uuid,key,bucket,name,content_type'],

            'frequency' => ['required', 'numeric'],
            'receiver' => ['nullable'],
            'message_id' => ['required', 'exists:messages,id'],
        ];
    }
}
