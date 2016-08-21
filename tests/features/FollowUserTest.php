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
        $user = factory(User::class)->create([]);
        $userToFollow = factory(User::class)->create(['username' => 'userToFollow']);

        $this->actingAs($user)
            ->visit('/userToFollow')
            ->press('Follow');

        $this->seePageIs('/userToFollow');
        $this->assertTrue($user->follows($userToFollow));
    }
}
