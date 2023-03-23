<?php

namespace App\Observers;

use App\Jobs\RelayDelete;
use App\Jobs\RelaySend;
use App\Models\Message;

class MessageObserver
{
    /**
     * Handle the message "created" event.
     */
    public function created(Message $message): void
    {
        dispatch(new RelaySend($message));
    }

    /**
     * Handle the message "updated" event.
     */
    public function updated(Message $message): void
    {
        //
    }

    /**
     * Handle the message "deleted" event.
     */
    public function deleted(Message $message): void
    {
        dispatch(new RelayDelete($message));
    }

    /**
     * Handle the message "restored" event.
     */
    public function restored(Message $message): void
    {
        //
    }

    /**
     * Handle the message "force deleted" event.
     */
    public function forceDeleted(Message $message): void
    {
        //
    }
}
