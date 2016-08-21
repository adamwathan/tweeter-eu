<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FollowingController extends Controller
{
    public function store()
    {
        $userToFollow = User::where('username', request('username'))->firstOrFail();

        Auth::user()->follow($userToFollow);

        return redirect()->back();
    }
}
