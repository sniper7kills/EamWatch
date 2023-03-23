<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ValidMessageTypeRule implements Rule
{
    /**
     * Array of valid message types.
     * All values should be in all upper case.
     *
     * @var array
     */
    private $validMessageTypes = [
        'SKYKING',
        'ALLSTATIONS',
        'RADIOCHECK',
        'SKYMASTER',
        'SKYBIRD',
        'DISREGARDED',
        'OTHER',
    ];

    public function __construct()
    {
        if (!Auth::guest() || !Auth::guard('api')->guest()) {
            if (!Auth::guest()) {
                if (Auth::user()->can('create backend message')) {
                    $this->validMessageTypes[] = 'BACKEND';
                }
                try {
                    if (Auth::user()->hasPermissionTo('create backend message', 'web')) {
                        $this->validMessageTypes[] = 'BACKEND';
                    }
                } catch (\Exception) {
                    //print("Exception");
                }
            } else {
                if (Auth::guard('api')->user()->can('create backend message')) {
                    $this->validMessageTypes[] = 'BACKEND';
                }
            }
        }
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  mixed  $value
     */
    public function passes($attribute, $value): bool
    {
        return in_array(strtoupper($value), $this->validMessageTypes);
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return 'Invalid Message Type Selected';
    }
}
