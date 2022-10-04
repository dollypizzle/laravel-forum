<?php

namespace App\Listeners;

use App\Events\ThreadHasNewReply;

class NotifyThreadSubscribers
{

    /**
     * Handle the event.
     *
     * @param  ThreadHasNewReply  $event
     * @return void
     */
    public function handle(ThreadHasNewReply $event)
    {
        $event->thread->notifySubscribers($event->reply);

    }
}
