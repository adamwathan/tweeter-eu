<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class UserFollowingController extends Controller
{
    public function index($username)
    {
        $user = User::findByUsername($username);

        return view('user-following.index', [
            'user' => $user,
            'following' => $user->following,
        ]);
    }
}
