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

    public function test_a_user_cant_follow_someone_they_already_follow()
    {
        $user = factory(User::class)->create([]);
        $userToFollow = factory(User::class)->create(['username' => 'userToFollow']);
        $user->follow($userToFollow);

        $this->actingAs($user)
            ->visit('/userToFollow')
            ->dontSeeInElement('button', 'Follow');
    }

    public function test_a_user_cant_follow_themselves()
    {
        $user = factory(User::class)->create(['username' => 'adam']);

        $this->actingAs($user)
            ->visit('/adam')
            ->dontSeeInElement('button', 'Follow');
    }
}
