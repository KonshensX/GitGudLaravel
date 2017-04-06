<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['content', 'user_id'];

    protected $appends = ['humanDate', 'userInfo', 'likesCount', 'commentsCount'];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function likes () {
        return $this->hasMany(Like::class);
    }

    public function comments () {
        return $this->hasMany(Comment::class)->get();
    }

    public function getHumanDateAttribute () {
        return $this->created_at->diffForHumans();
    }

    public function getUserInfoAttribute () {
        return $this->user()->first();
    }

    public function getLikesCountAttribute () {
        return $this->likes()->count();
    }

    public function getCommentsCountAttribute () {
        return $this->comments()->count();
    }
}
