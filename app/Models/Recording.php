<?php

namespace App\Models;

use App\Models\Concerns\GeneratesUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Recording extends \App\Models\AbstractModels\AbstractRecording
{
    use HasFactory;
    use GeneratesUuid;

    public function getTimeAttribute()
    {
        return Carbon::make($this->attributes['broadcasted_at'])->toDateTimeString();
    }

    /**
     * Set the message property for the model using a fake attribute.
     */
    public function setMessageAttribute(Message $message)
    {
        $this->setAttribute('message_id', $message->id);
    }

    /**
     * Set the userable properties for the model using a fake attribute.
     */
    public function setUserAttribute(Model $user)
    {
        $this->attributes['userable_id'] = $user->getKey();
        $this->attributes['userable_type'] = $user->getMorphClass();
    }

    /**
     * Set the broadcast_ts attribute using a fake attribute.
     *
     * @param $time
     */
    public function setTimeAttribute($time)
    {
        $this->attributes['broadcasted_at'] = Carbon::make($time);
    }

    public function getLinkAttribute()
    {
        $rootPath = '';
        if (!$this->automated) {
            $rootPath .= 'recordings/' . $this->message_id . '/';
        } else {
            $rootPath .= 'automated/';
        }
        $rootPath .= $this->id;

        return Storage::url($rootPath);
    }
}
