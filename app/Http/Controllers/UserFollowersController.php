<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserFollowersController extends Controller
{
    public function index($username)
    {
        $user = User::findByUsername($username);

        return view('user-followers.index', [
            'user' => $user,
            'followers' => $user->followers,
        ]);
    }
}
