<?php

use App\User;
use App\Tweet;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewFollowersTest extends TestCase
{
    use DatabaseMigrations;

    public function test_view_who_follows_a_user()
    {
        $me = factory(User::class)->create(['username' => 'adam']);
        $following = factory(User::class)->create(['username' => 'jane']);
        $notFollowing = factory(User::class)->create(['username' => 'steve']);
        $following->follow($me);

        $this->actingAs($me)->visit('/adam/followers');

        $this->seeInElement('#followers', "jane");
        $this->dontSeeInElement('#followers', "steve");
    }
}
