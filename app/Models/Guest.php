<?php

namespace App\Models;

use App\Models\Concerns\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guest extends \App\Models\AbstractModels\AbstractGuest
{
    use GeneratesUuid;
    use HasFactory;

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
