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
        $john = factory(User::class)->create(['username' => 'john']);
        $john->tweets()->save(factory(Tweet::class)->make(['body' => "john's tweet"]));

        factory(User::class)->create(['username' => 'jane'])
            ->tweets()->save(factory(Tweet::class)->make(['body' => "jane's tweet"]));

        factory(User::class)->create(['username' => 'steve'])
            ->tweets()->save(factory(Tweet::class)->make(['body' => "steve's tweet"]));

        $this->actingAs($john)
            ->visit('/')
            ->see("john's tweet")
            ->see("jane's tweet")
            ->see("steve's tweet");
    }
}
