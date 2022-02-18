<?php

namespace App\Listeners;

use App\Events\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\SendNotificationMail;
use Mail;

class MailNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  SendMail  $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        $email = $event->data['to'];
        Mail::to($email)->send(new SendNotificationMail($event->data));
    }
}
