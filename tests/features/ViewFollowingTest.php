<?php

use App\User;
use App\Tweet;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewFollowingTest extends TestCase
{
    use DatabaseMigrations;

    public function test_view_who_a_user_is_following()
    {
        $me = factory(User::class)->create(['username' => 'adam']);
        $followed = factory(User::class)->create(['username' => 'jane']);
        $notFollowed = factory(User::class)->create(['username' => 'steve']);
        $me->follow($followed);

        $this->actingAs($me)->visit('/adam/following');

        $this->seeInElement('#following', "jane");
        $this->dontSeeInElement('#following', "steve");
    }
}
