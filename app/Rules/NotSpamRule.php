<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class NotSpamRule implements Rule
{
    /**
     * Regex Rules to test for spam input.
     *
     * @var array
     */
    private $regexRules = [
        'not_regex:/[hH][tT]{2}[pP]:\/\//',
        'not_regex:/[hH][tT]{2}[pP][sS]:\/\//',
        'not_regex:/\[[uU][rR][lL]=/',
        'not_regex:/\<[aA]\s[hH][rR][eE][fF]/',
    ];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes(string $attribute, $value): bool
    {
        $validator = Validator::make(
            [
                'message' => $value,
            ],
            [
                'message' => $this->regexRules,
            ]
        );

        return $validator->passes();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The input appears to be spam.';
    }
}
