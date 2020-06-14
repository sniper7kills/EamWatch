<?php
namespace App\Models;

use App\Models\Concerns\GeneratesUuid;

class Guest extends \App\Models\AbstractModels\AbstractGuest
{
    use GeneratesUuid;

    static public function current()
    {
        return Guest::firstOrCreate([
            'ip' => request()->getClientIp()
        ]);
    }

    public function displayRole()
    {
        return "Guest";
    }
}
