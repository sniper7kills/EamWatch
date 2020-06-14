<?php

namespace App\Http\Requests;

use App\Concerns\GetCurrentUserOrGuest;
use App\Models\Guest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    use GetCurrentUserOrGuest;
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
            'banned' => [
                'nullable',
                'boolean'
            ],
            'name' => [
                'nullable',
                'string'
            ],
            'email' => [
                'nullable',
                'email',
                'unique:users,email'
            ],
            'password' => [
                'nullable',
                'min:8'
            ],
            'password_confirm' => [
                'nullable',
                'required_with:password',
                'same:password'
            ],
            'role' => [
                'nullable',
                Rule::in(['Member', 'Moderator', 'Admin']),
            ]
        ];
    }
}
