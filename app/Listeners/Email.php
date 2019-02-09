<?php

namespace App\Listeners;

use App\Events\NotifyAdmin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Email
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotifyAdmin  $event
     * @return void
     */
    public function handle(NotifyAdmin $event)
    {
        //
    }
}
