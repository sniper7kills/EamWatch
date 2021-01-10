<?php

namespace App\Rules;

use Illuminate\Validation\Validator;

class MessageValidForTypeValidator extends Validator
{
    public function validateMessageValidForType($attribute, $value, $parameters)
    {
        $regexRules = [
            'ALLSTATIONS' => [
                '/[^a-zA-Z0-9]/',
            ],
            'SKYKING' => [
                '/[a-zA-Z\s]*[^a-zA-Z\s]+[a-zA-Z\s]* TIME/',
                '/TIME [0-9]{1} AUTH/',
                '/TIME [0-9]*[^0-9]+[0-9]* AUTH/',
                '/AUTH [a-zA-Z]{1}$/',
                '/AUTH [a-zA-Z]*[^a-zA-Z]+[a-zA-Z]*$/',
            ],
        ];

        $messageType = strtoupper($this->data['type']);
        $message = $this->data['message'];

        if (! array_key_exists($messageType, $regexRules)) {
            return true;
        }

        foreach ($regexRules[$messageType] as $rule) {
            if (0 < preg_match_all($rule, $message)) {
                return false;
            }
        }

        return true;
    }
}
