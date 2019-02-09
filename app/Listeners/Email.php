<?php

namespace App\Listeners;

use App\Events\NotifyAdmin;
use App\Mail\SendSystemInfo;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

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
        // 发送邮件
        Mail::to(env('ADMIN_EMAIL'))->send(new SendSystemInfo($event->content));
    }
}
