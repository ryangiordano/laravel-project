<?php

namespace App\Listeners;

use App\Events\QuoteCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendUserNotification
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
     * @param  QuoteCreated  $event
     * @return void
     */
    public function handle(QuoteCreated $event)
    {
      $author =   $event->author;
      $email = $author->email;

      Mail::send('email.user_notification', ['name'=>$author-name],function($message){
        $message->from('admin@mytest.com','Admin');
        $message->to($email);
        $message->subject('Thank you for your quote');
      });
    }
}
