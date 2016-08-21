<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use App\Events\NewFollower;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;

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
