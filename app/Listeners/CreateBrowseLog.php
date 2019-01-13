<?php

namespace App\Listeners;

use App\Events\UserBrowse;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateBrowseLog
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
     * @param  UserBrowse  $event
     * @return void
     */
    public function handle(UserBrowse $event)
    {
        //
    }
}
