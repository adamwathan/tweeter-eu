<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_user_can_be_found_by_username()
    {
        $createdUser = factory(User::class)->create(['username' => 'janedoe']);

        $foundUser = User::findByUsername('janedoe');

        $this->assertEquals($createdUser->id, $foundUser->id);
        $this->assertEquals('janedoe', $foundUser->username);
    }

    public function test_post_new_tweet()
    {
        $user = factory(User::class)->create();

        $user->tweet('My first tweet');

        $tweet = $user->tweets()->first();
        $this->assertNotNull($tweet);
        $this->assertEquals('My first tweet', $tweet->body);
    }

    public function test_can_follow_another_user()
    {
        $john = factory(User::class)->create(['username' => 'john']);
        $mary = factory(User::class)->create(['username' => 'mary']);
        $this->assertFalse($john->follows($mary));

        $john->follow($mary);
        $this->assertTrue($john->follows($mary));
    }

    public function test_following_the_same_user_again_does_not_duplicate_the_record()
    {
        $john = factory(User::class)->create(['username' => 'john']);
        $mary = factory(User::class)->create(['username' => 'mary']);
        $this->assertFalse($john->follows($mary));

        $john->follow($mary);
        $john->follow($mary);
        $this->assertTrue($john->follows($mary));
        $this->assertEquals(1, $john->following()->count());
    }
}
