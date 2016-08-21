<?php

use App\User;
use App\Tweet;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewTimelineTest extends TestCase
{
    use DatabaseMigrations;

    public function test_viewing_main_timeline()
    {
        $me = factory(User::class)->create();
        $me->tweet("My tweet!");

        $followed = factory(User::class)->create();
        $followed->tweet("Followed's tweet!");
        $me->follow($followed);

        $notFollowed = factory(User::class)->create();
        $notFollowed->tweet("Not followed's tweet!");

        $this->actingAs($me)->visit('/');

        $this->see("My tweet!");
        $this->see("Followed's tweet!");
        $this->dontSee("Not followed's tweet!");
    }
}
