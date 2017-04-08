<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Comment extends Model
{
    protected $fillable = ['comment', 'user_id', 'post_id'];

    protected $appends = ['avatarUrl'];

    public function post () {
        return $this->belongsTo(Post::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function getAvatarUrlAttribute () {
        return $this->user->avatar_name;
    }
}
