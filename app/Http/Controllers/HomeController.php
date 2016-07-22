<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

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
