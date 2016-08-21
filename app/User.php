<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function equals($user)
    {
        return $this->id == $user->id;
    }

    public static function findByUsername($username)
    {
        return self::where('username', $username)->first();
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function latestTweets()
    {
        return $this->tweets()->latest();
    }

    public function tweet($tweetBody)
    {
        $this->tweets()->create(['body' => $tweetBody]);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id');
    }

    public function canFollow($user)
    {
        return ($user->id != $this->id) && $this->following()->where('users.id', $user->id)->count() == 0;
    }

    public function follow($user)
    {
        if ($this->follows($user)) {
            return;
        }
        $this->following()->attach($user);
    }

    public function follows($user)
    {
        return $this->following()->where('following_id', $user->id)->count() > 0;
    }
}
