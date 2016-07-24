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
}
