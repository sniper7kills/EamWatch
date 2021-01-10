<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\GeneratesUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends \App\Models\AbstractModels\AbstractComment
{
    use HasFactory;

    use GeneratesUuid;

    /**
     * Set the userable properties for the model using a fake attribute.
     *
     * @param Model $user
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
