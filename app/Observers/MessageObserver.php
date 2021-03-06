<?php

namespace App\Observers;

use App\Jobs\RelayDelete;
use App\Jobs\RelaySend;
use App\Models\Message;

class MessageObserver
{
    /**
     * Handle the message "created" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function created(Message $message)
    {
        dispatch(new RelaySend($message));
    }

    /**
     * Handle the message "updated" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function updated(Message $message)
    {
        //
    }

    /**
     * Handle the message "deleted" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function deleted(Message $message)
    {
        dispatch(new RelayDelete($message));
    }

    /**
     * Handle the message "restored" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function restored(Message $message)
    {
        //
    }

    /**
     * Handle the message "force deleted" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function forceDeleted(Message $message)
    {
        //
    }
}
