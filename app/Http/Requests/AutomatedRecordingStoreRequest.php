<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutomatedRecordingStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'uuid' => ['required_without:file'],
            'key' => ['required_without:file'],
            'bucket' => ['required_without:file'],
            'name' => ['required_without:file'],
            'content_type' => ['required_without:file'],
            'file' => ['required_without:uuid,key,bucket,name,content_type'],

            'time' => ['required', 'date'],
            'frequency' => ['required', 'numeric'],
            'receiver' => ['nullable'],
        ];
    }
}
