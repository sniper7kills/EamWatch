<?php

namespace App\Rules;

use Illuminate\Validation\Validator;

class MessageValidForTypeValidator extends Validator
{
    public function validateMessageValidForType($attribute, $value, $parameters)
    {
        $regexRules = [
            'ALLSTATIONS' => [
                '/[^a-zA-Z0-9]/' => false,
            ],
            'SKYKING' => [
                '/[a-zA-Z\s]*[^a-zA-Z\s]+[a-zA-Z\s]* TIME/' => false,
                '/TIME [0-9]{1} AUTH/' => false,
                '/TIME [0-9]*[^0-9]+[0-9]* AUTH/' => false,
                '/AUTH [a-zA-Z]{1}$/' => false,
                '/AUTH [a-zA-Z]*[^a-zA-Z]+[a-zA-Z]*$/' => false,
                '/[A-Za-z\s]+ TIME [0-9]{2} AUTH [A-Za-z]{2}/' => true,
            ],
        ];

        $messageType = strtoupper($this->data['type']);
        $message = $this->data['message'];

        if (! array_key_exists($messageType, $regexRules)) {
            return true;
        }

        foreach ($regexRules[$messageType] as $rule => $passes) {
            $results = preg_match_all($rule, $message);
            if (!$passes && $results > 0) {
                return false;
            }
            if ($passes && $results == 0) {
                return false;
            }
        }

        return true;
    }
}
