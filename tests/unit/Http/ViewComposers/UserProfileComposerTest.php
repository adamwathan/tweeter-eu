<?php

use App\User;
use App\Tweet;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserProfileComposerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_the_user_profile_partial_contains_a_users_tweet_count()
    {
        $user = factory(User::class)->create(['username' => 'janedoe']);
        $user->tweets()->saveMany([
            factory(Tweet::class)->make(),
            factory(Tweet::class)->make(),
            factory(Tweet::class)->make(),
        ]);

        $view = View::make('partials.user-profile', ['user' => $user]);
        View::callComposer($view);

        $this->assertEquals(3, $view->tweetCount);
    }

    public function test_the_user_profile_partial_contains_a_users_following_count()
    {
        $user = factory(User::class)->create(['username' => 'janedoe']);
        $user->follow(factory(User::class)->create());
        $user->follow(factory(User::class)->create());

        $view = View::make('partials.user-profile', ['user' => $user]);
        View::callComposer($view);

        $this->assertEquals(2, $view->followingCount);
    }

    public function test_the_user_profile_partial_contains_a_users_follower_count()
    {
        $user = factory(User::class)->create(['username' => 'janedoe']);
        factory(User::class)->create()->follow($user);
        factory(User::class)->create()->follow($user);

        $view = View::make('partials.user-profile', ['user' => $user]);
        View::callComposer($view);

        $this->assertEquals(2, $view->followerCount);
    }
}
