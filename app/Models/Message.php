<?php

namespace App\Models;

use App\Models\Concerns\GeneratesUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends \App\Models\AbstractModels\AbstractMessage
{
    use GeneratesUuid, SoftDeletes;
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        $this->fillable[] = 'time';
        parent::__construct($attributes);
    }

    public function getTimeAttribute()
    {
        return Carbon::make($this->attributes['broadcast_ts'])->toDateTimeString();
    }

    /**
     * Set the type to Upper Case.
     */
    public function setTypeAttribute($type)
    {
        $this->attributes['type'] = strtoupper($type);
    }

    /**
     * Set the message to upper case.
     */
    public function setMessageAttribute($message)
    {
        $this->attributes['message'] = strtoupper($message);
    }

    /**
     * Set the Sender to upper case.
     */
    public function setSenderAttribute($sender)
    {
        $this->attributes['sender'] = strtoupper($sender);
    }

    /**
     * Set the Receiver to upper case.
     */
    public function setReceiverAttribute($receiver)
    {
        $this->attributes['receiver'] = strtoupper($receiver);
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
     */
    public function setTimeAttribute($time)
    {
        $this->attributes['broadcast_ts'] = Carbon::make($time);
    }

    /**
     * Returns the 5 newest comments.
     */
    public function getLastFiveCommentsAttribute(): Collection
    {
        return $this->comments()->orderBy('created_at', 'DESC')->limit(5)->get();
    }

    /**
     * Returns the 5 newest recordings.
     */
    public function getLastFiveRecordingsAttribute(): Collection
    {
        return $this->recordings()->orderBy('created_at', 'DESC')->limit(5)->get();
    }
}
