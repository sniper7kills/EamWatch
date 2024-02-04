<?php

namespace App\Models;

use App\Models\Concerns\Encryptable;
use App\Models\Concerns\GeneratesUuid;

class RelayProvider extends \App\Models\AbstractModels\AbstractRelayProvider
{
    use Encryptable, GeneratesUuid;

    protected $encryptable = [
        'details',
    ];
}
