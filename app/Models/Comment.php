<?php

namespace App\Models;

use App\Models\Concerns\GeneratesUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends \App\Models\AbstractModels\AbstractComment
{
    use HasFactory;
    use GeneratesUuid;
    use SoftDeletes;

    /**
     * Set the userable properties for the model using a fake attribute.
     */
    public function setUserAttribute(Model $user)
    {
        $this->attributes['userable_id'] = $user->getKey();
        $this->attributes['userable_type'] = $user->getMorphClass();
    }

    public function getTimeAttribute()
    {
        return Carbon::make($this->attributes['created_at'])->toDateTimeString();
    }
}
