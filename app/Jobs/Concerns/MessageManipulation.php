<?php

namespace App\Jobs\Concerns;

trait MessageManipulation
{
    private function getFormattedMessage()
    {
        if ($this->message->type != 'ALLSTATIONS') {
            return $this->message->message;
        }

        if (strlen($this->message->message) == 30) {
            return $this->message->message;
        }

        return '['.strlen($this->message->message).' CHAR] '.$this->message->message;
    }
}
