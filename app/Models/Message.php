<?php
namespace App\Models;

use App\Models\Concerns\GeneratesUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Message extends \App\Models\AbstractModels\AbstractMessage
{
    use GeneratesUuid;

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
     * Set the type to Upper Case
     *
     * @param $type
     */
    public function setTypeAttribute($type)
    {
        $this->attributes['type'] = strtoupper($type);
    }

    /**
     * Set the message to upper case
     *
     * @param $message
     */
    public function setMessageAttribute($message)
    {
        $this->attributes['message'] = strtoupper($message);
    }

    /**
     * Set the Sender to upper case
     *
     * @param $sender
     */
    public function setSenderAttribute($sender)
    {
        $this->attributes['sender'] = strtoupper($sender);
    }

    /**
     * Set the Receiver to upper case
     *
     * @param $receiver
     */
    public function setReceiverAttribute($receiver)
    {
        $this->attributes['receiver'] = strtoupper($receiver);
    }

    /**
     * Set the userable properties for the model using a fake attribute
     *
     * @param Model $user
     */
    public function setUserAttribute(Model $user)
    {
        $this->attributes['userable_id'] = $user->getKey();
        $this->attributes['userable_type'] = $user->getMorphClass();
    }

    /**
     * Set the broadcast_ts attribute using a fake attribute
     *
     * @param $time
     */
    public function setTimeAttribute($time)
    {
        $this->attributes['broadcast_ts'] = Carbon::make($time);
    }
}
