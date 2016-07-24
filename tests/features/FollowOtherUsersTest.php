<?php

use App\User;
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
}
