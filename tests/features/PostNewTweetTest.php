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
            ->post('/tweets', ['tweet' => 'My first tweet']);

        $this->assertEquals('My first tweet', $user->tweets()->first()->body);
    }

    public function test_a_body_is_required_when_posting_a_tweet()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post('/tweets', ['tweet' => '']);

        $this->assertEquals(0, $user->tweets()->count());
        $this->assertSessionHasErrors('tweet');
    }

    public function test_tweets_cannot_exceed_141_characters()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post('/tweets', ['tweet' => str_repeat('a', 142)]);

        $this->assertEquals(0, $user->tweets()->count());
        $this->assertSessionHasErrors('tweet');
    }
}
