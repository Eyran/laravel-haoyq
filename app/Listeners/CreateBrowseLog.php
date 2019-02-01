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
     * @param  UserBrowse $event
     * @return void
     */
    public function handle(UserBrowse $event)
    {
        // 本地访问不做记录
        $arr = ['127.0.0.1'];

        if (!in_array($event->ip_addr, $arr)) {
            $log = new \App\Models\BrowseLog();

            $log->ip_addr = $event->ip_addr;
            $log->request_url = $event->request_url;
            $log->city_name = $event->city_name;

            $log->save();
        }
    }
}
