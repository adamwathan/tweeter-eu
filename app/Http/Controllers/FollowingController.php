<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = Auth::user()->following;

        return view('following.index', [
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $user_to_follow = User::where('username', $request->input('username'))->firstOrFail();

        Auth::user()->follow($user_to_follow);

        return redirect('/tweets');
    }

    public function destroy($username)
    {
        $user_to_unfollow = User::where('username', $username)->firstOrFail();

        Auth::user()->unfollow($user_to_unfollow);

        return redirect('/tweets');
    }
}
