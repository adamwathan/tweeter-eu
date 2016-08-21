<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetsController extends Controller
{
    public function store()
    {
        $this->validate(request(), [
            'tweet' => ['required', 'max:141'],
        ]);

        Auth::user()->tweet(request('tweet'));

        return redirect('/');
    }
}
