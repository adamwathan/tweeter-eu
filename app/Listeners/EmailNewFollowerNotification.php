<?php

namespace App\Listeners;

use App\Events\NewFollower;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailNewFollowerNotification
{
    private $mailer;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        //
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  NewFollower  $event
     * @return void
     */
    public function handle(NewFollower $event)
    {
        $this->mailer->send('emails.new-follower', ['user' => $event->follower], function ($m) use ($event) {
            $m->to($event->followed->email)->subject("You have a new follower!");
        });
    }
}
