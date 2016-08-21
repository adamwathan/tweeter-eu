<?php

namespace App\Http\Controllers;

use Auth;
use App\Tweet;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::guest()) {
            return view('welcome');
        }

        return $this->timeline();
    }

    private function timeline()
    {
        $tweets = Auth::user()->timeline()->paginate(20);

        return view('timeline.index', [
            'tweets' => $tweets,
        ]);
    }
}
