<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowingController extends Controller
{
    public function index()
    {
        $users = Auth::user()->following;

        return view('following.index', [
            'users' => $users,
        ]);
    }

    public function store()
    {
        $user_to_follow = User::where('username', request('username'))->firstOrFail();

        Auth::user()->follow($user_to_follow);

        return redirect()->route('following.index');
    }

    public function destroy($username)
    {
        $user_to_unfollow = User::where('username', $username)->firstOrFail();

        Auth::user()->unfollow($user_to_unfollow);

        return redirect()->back();
    }
}
