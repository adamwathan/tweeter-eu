<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Tweet;
use App\User;
use Auth;
use Illuminate\Support\Facades\Request;

class TweetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tweets = Auth::user()->tweets()->latest()->paginate(20);

        return view('tweets.index', [
            'tweets' => $tweets,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store()
    {
        $this->validate(Request::instance(), ['tweet' => ['required', 'max:141']]);

        Auth::user()->tweets()->create([
            'message' => Request::input('tweet'),
        ]);

        return redirect()->back();
    }
}
