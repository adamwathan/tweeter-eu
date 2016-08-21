<?php

use App\User;
use App\Events\NewFollower;
use MailThief\Facades\MailThief;
use App\Listeners\EmailNewFollowerNotification;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmailNewFollowerNotificationTest extends TestCase
{
    public function test_it_sends_a_notification_email_to_the_user_being_followed()
    {
        $mailthief = MailThief::instance();
        $listener = new EmailNewFollowerNotification($mailthief);
        $follower = factory(User::class)->make(['username' => 'dhh']);
        $followed = factory(User::class)->make([
            'username' => 'adamwathan',
            'email' => 'adamwathan@example.com',
        ]);

        $listener->handle(new NewFollower($follower, $followed));

        $this->assertTrue($mailthief->hasMessageFor('adamwathan@example.com'));
        $this->assertTrue($mailthief->lastMessage()->contains('dhh'));
        $this->assertContains("new follower", $mailthief->lastMessage()->subject);
    }
}
