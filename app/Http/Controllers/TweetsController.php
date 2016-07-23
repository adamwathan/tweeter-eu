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
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store()
    {
        $this->validate(request(), ['tweet' => ['required', 'max:141']]);

        Auth::user()->tweets()->create([
            'body' => request('tweet'),
        ]);

        return redirect()->back();
    }
}
