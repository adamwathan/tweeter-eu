<?php

use App\User;
use App\Events\NewFollower;
use Illuminate\Mail\Message;
use MailThief\Facades\MailThief;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Facade;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FollowOtherUsersTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        MailThief::hijack();
    }

    public function est_a_user_can_follow_another_user()
    {
        $user = factory(User::class)->create([]);
        $userToFollow = factory(User::class)->create(['username' => 'to-follow']);

        $this->actingAs($user)
            ->post('/following', ['username' => 'to-follow']);

        $this->assertRedirectedToRoute('following.index');
        $this->assertTrue($user->follows($userToFollow));
    }

    public function test_a_new_follower_event_is_fired_when_following_another_user()
    {
        $this->expectsEvents(NewFollower::class);

        $user = factory(User::class)->create(['username' => 'johndoe']);
        $userToFollow = factory(User::class)->create(['username' => 'to-follow']);

        $this->actingAs($user)
            ->post('/following', ['username' => 'to-follow']);
    }
}
