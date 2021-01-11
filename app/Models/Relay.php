<?php

namespace App\Models;

use App\Models\Concerns\GeneratesUuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relay extends \App\Models\AbstractModels\AbstractRelay
{
    use GeneratesUuid, SoftDeletes;
}
