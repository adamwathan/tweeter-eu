<?php

use App\User;
use App\Tweet;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GetUsersTweetsTest extends TestCase
{
    use DatabaseMigrations;

    public function test_view_a_users_tweets()
    {
        $user = factory(User::class)->create(['username' => 'johndoe']);
        $user->tweets()->saveMany([
            factory(Tweet::class)->make(['body' => 'My first tweet', 'created_at' => Carbon::parse('2 weeks ago')]),
            factory(Tweet::class)->make(['body' => 'My second tweet', 'created_at' => Carbon::parse('1 week ago')]),
        ]);

        $this->json('GET', '/api/johndoe/tweets');

        $this->seeJsonSubset([
            [
                'body' => 'My second tweet'
            ],
            [
                'body' => 'My first tweet'
            ]
        ]);
    }
}
