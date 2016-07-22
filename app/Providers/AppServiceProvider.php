<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
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
        view()->composer('partials.who-to-follow', function ($view) {
            $users = Auth::user()->notFollowing()->latest()->limit(5)->get();
            $view->with('users', $users);
        });

        view()->composer('partials.user-profile', function ($view) {
            $view->with('tweetCount', Auth::user()->tweets()->count());
            $view->with('followerCount', Auth::user()->followers()->count());
            $view->with('followingCount', Auth::user()->following()->count());
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
