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
        "SKYKING",
        "ALLSTATIONS",
        "RADIOCHECK",
        "SKYMASTER",
        "SKYBIRD",
        "DISREGARDED",
        "OTHER"
    ];

    public function __construct()
    {
        if(Auth::user())
        {
            if(Auth::user()->can('create backend message'))
                $this->validMessageTypes[] = "BACKEND";
        }
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array(strtoupper($value), $this->validMessageTypes);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid Message Type Selected';
    }
}
