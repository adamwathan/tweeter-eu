<?php

namespace App\Http\Controllers;

use App\User;

class UsersController extends Controller
{
    public function show($username)
    {
        $user = User::findByUsername($username);
        return view('users.show', [
            'user' => $user,
        ]);
    }
}
