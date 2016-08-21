<?php

namespace App\Providers;

use App\User;
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
            $users = User::latest()->limit(5)->get();
            $view->with('users', $users);
        });

        View::composer('partials.user-profile', function ($view) {
            $view->with('tweetCount', $view->user->tweets()->count());
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
