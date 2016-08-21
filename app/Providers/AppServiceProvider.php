<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('partials.who-to-follow', function ($view) {
            $users = Auth::user()->notFollowing()->latest()->limit(5)->get();
            $view->with('users', $users);
        });

        View::composer('partials.user-profile', function ($view) {
            $view->with('tweetCount', $view->user->tweets()->count());
            $view->with('followerCount', $view->user->followers()->count());
            $view->with('followingCount', $view->user->following()->count());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
