<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostNewTweetTest extends TestCase
{
    use DatabaseMigrations;

    public function test_posting_a_new_tweet()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/')
            ->type('My first tweet', 'tweet')
            ->press('Tweet')
            ->see('My first tweet');
    }
}
