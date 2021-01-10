<?php

namespace App\Models;

use App\Models\Concerns\GeneratesUuid;

class Guest extends \App\Models\AbstractModels\AbstractGuest
{
    use GeneratesUuid;

    public static function current()
    {
        return self::firstOrCreate([
            'ip' => request()->getClientIp(),
        ]);
    }

    public function displayRole()
    {
        return 'Guest';
    }
}
