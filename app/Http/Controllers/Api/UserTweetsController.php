<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserTweetsController extends Controller
{
    public function index($username)
    {
        return User::findByUsername($username)->latestTweets;
    }
}
