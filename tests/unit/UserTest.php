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

    public function test_user_is_allowed_to_follow_someone_they_do_not_follow()
    {
        $john = factory(User::class)->create(['username' => 'john']);
        $mary = factory(User::class)->create(['username' => 'mary']);

        $this->assertTrue($john->canFollow($mary));
    }

    public function test_user_is_not_allowed_to_follow_someone_they_already_follow()
    {
        $john = factory(User::class)->create(['username' => 'john']);
        $mary = factory(User::class)->create(['username' => 'mary']);
        $john->follow($mary);

        $this->assertFalse($john->canFollow($mary));
    }

    public function test_user_is_not_allowed_to_follow_themselves()
    {
        $john = factory(User::class)->create(['username' => 'john']);

        $this->assertFalse($john->canFollow($john));
    }

    public function test_timeline_contains_users_tweets()
    {
        $user = factory(User::class)->create();
        $user->tweet("My tweet!");

        $tweets = $user->timeline()->get();

        $this->assertTrue($tweets->contains(function ($tweet) {
            return $tweet->body == "My tweet!";
        }));
    }

    public function test_timeline_contains_tweets_from_followed_users()
    {
        $user = factory(User::class)->create();
        $following = factory(User::class)->create();
        $user->follow($following);
        $following->tweet("Following tweet!");

        $tweets = $user->timeline()->get();

        $this->assertTrue($tweets->contains(function ($tweet) {
            return $tweet->body == "Following tweet!";
        }));
    }

    public function test_timeline_does_not_contain_tweets_from_users_not_followed()
    {
        $user = factory(User::class)->create();
        $notFollowing = factory(User::class)->create();
        $notFollowing->tweet("Not following tweet!");

        $tweets = $user->timeline()->get();

        $this->assertFalse($tweets->contains(function ($tweet) {
            return $tweet->body == "Following tweet!";
        }));
    }
}
