<?php

namespace App;

use App\Following;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $appends = [
        'avatarUrl',
        'humanDate',
        'isFollowed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts () {
        $this->hasMany(Post::class);
    }

    public function comments () {
        return $this->hasMany(Comment::class);
    }

    public function following ()  {
        return $this->hasMany(Following::class);
    }

    /**
     * Gets the avatar for the user
     * @return mixed
     */
    public function getAvatarUrlAttribute () {
        if ($this->avatar_name) {
            return URL::asset("uploads/avatar/$this->avatar_name");
        }
        return URL::asset("img/profilepic.png");
    }

    public function getHumanDateAttribute () {
        return $this->created_at->diffForHumans();
    }


    public function getIsFollowedAttribute () {
        // How do i know if the current logged in user is following this person or not
        // Check if a row exists where the user_id an the followed_id 
        // Take #1
        // Where am i going to get the following_id from ???
        /*
        $result = Following::
        */
        // I have a list of following id and i need some how to only get the current 
        // Maybe i just check if the current user is in the following relationship 
        $result = $this->following()->where([
            'user_id' => Auth::user()->id,
            'followed_id' => $this->id,
        ])->get();
        //dd($result);
        if ($result) {
            return true;
        }
        return false;
    }

}
