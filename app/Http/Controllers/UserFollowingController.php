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

        return view('following.index', [
            'user' => $user,
            'following' => $user->following,
        ]);
    }

    public function store()
    {
        $userToFollow = User::where('username', request('username'))->firstOrFail();

        Auth::user()->follow($userToFollow);

        Event::fire(new NewFollower(Auth::user(), $userToFollow));

        return redirect()->route('following.index');
    }

    public function destroy($username)
    {
        $user_to_unfollow = User::where('username', $username)->firstOrFail();

        Auth::user()->unfollow($user_to_unfollow);

        return redirect()->back();
    }
}
