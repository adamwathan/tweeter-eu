<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetsController extends Controller
{
    public function store()
    {
        Auth::user()->tweet(request('tweet'));
        return redirect('/');
    }
}
