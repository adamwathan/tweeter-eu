<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $userToFollow = User::where('username', request('username'))->firstOrFail();

        Auth::user()->follow($userToFollow);

        Mail::send('emails.new-follower', [], function ($m) use ($userToFollow) {
            $m->to($userToFollow->email);
        });

        return redirect()->route('following.index');
    }

    public function destroy($username)
    {
        $user_to_unfollow = User::where('username', $username)->firstOrFail();

        Auth::user()->unfollow($user_to_unfollow);

        return redirect()->back();
    }
}
