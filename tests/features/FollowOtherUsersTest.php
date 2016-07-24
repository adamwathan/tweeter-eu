<?php

use App\User;
use Illuminate\Mail\Message;
use MailThief\Facades\MailThief;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FollowOtherUsersTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_user_can_follow_another_user()
    {
        $user = factory(User::class)->create();
        $userToFollow = factory(User::class)->create(['username' => 'to-follow']);

        $this->actingAs($user)
            ->post('/following', ['username' => 'to-follow']);

        $this->assertRedirectedToRoute('following.index');
        $this->assertTrue($user->follows($userToFollow));
    }

    public function test_a_user_receives_a_notification_email_when_they_are_followed()
    {
        $user = factory(User::class)->create(['username' => 'johndoe']);
        $userToFollow = factory(User::class)->create(['username' => 'to-follow']);

        MailThief::hijack();

        $this->actingAs($user)
            ->post('/following', ['username' => 'to-follow']);

        $this->assertTrue(MailThief::hasMessageFor($userToFollow->email));
        $this->assertTrue(MailThief::lastMessage()->contains('johndoe'));
        $this->assertContains("new follower", MailThief::lastMessage()->subject);
    }
}
