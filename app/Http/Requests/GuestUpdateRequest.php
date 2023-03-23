<?php

namespace App\Http\Requests;

use App\Concerns\GetCurrentUserOrGuest;
use Illuminate\Foundation\Http\FormRequest;

class GuestUpdateRequest extends FormRequest
{
    use GetCurrentUserOrGuest;

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
            'banned' => [
                'nullable',
                'boolean',
            ],
        ];
    }
}
