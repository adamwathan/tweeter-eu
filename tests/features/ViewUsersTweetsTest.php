<?php

use App\User;
use App\Tweet;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewUsersTweetsTest extends TestCase
{
    use DatabaseMigrations;

    public function test_view_a_users_tweets()
    {
        $user = factory(User::class)->create(['username' => 'johndoe']);
        $tweet = factory(Tweet::class)->create(['body' => 'My first tweet']);
        $user->tweets()->save($tweet);

        $this->visit('/johndoe')
            ->see('My first tweet');
    }
}
