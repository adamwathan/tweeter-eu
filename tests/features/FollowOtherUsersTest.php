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

    public function test_a_user_can_follow_another_user()
    {
        $user = factory(User::class)->create([]);
        $userToFollow = factory(User::class)->create(['username' => 'to-follow']);
        Event::spy();

        $this->actingAs($user)
            ->post('/following', ['username' => 'to-follow']);

        $this->assertRedirectedToRoute('user-following.index', ['username' => $user->username]);
        $this->assertTrue($user->follows($userToFollow));
        Event::shouldHaveReceived('fire')->with(Mockery::on(function ($event) use ($user, $userToFollow) {
            return $event->follower->equals($user) && $event->followed->equals($userToFollow);
        }));
    }
}
