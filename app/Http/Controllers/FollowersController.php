<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowersController extends Controller
{
    public function index()
    {
        $users = Auth::user()->followers;

        return view('followers.index', [
            'users' => $users,
        ]);
    }
}
