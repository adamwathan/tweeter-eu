<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UnfollowUserTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_user_can_unfollow_someone_they_are_following()
    {
        $user = factory(User::class)->create([]);
        $userToUnfollow = factory(User::class)->create(['username' => 'userToUnfollow']);
        $user->follow($userToUnfollow);

        $this->actingAs($user)
            ->delete('/following/userToUnfollow');

        $this->assertRedirectedToRoute('user-following.index', ['username' => $user->username]);
        $this->assertFalse($user->follows($userToUnfollow));
    }
}
