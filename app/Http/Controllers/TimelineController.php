<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Tweet;
use App\User;
use Auth;
use Illuminate\Support\Facades\Request;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tweets = Tweet::paginate(20);

        return view('timeline.index', [
            'tweets' => $tweets,
        ]);
    }
}
