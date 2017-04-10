<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class Post extends Model
{
    protected $fillable = [
        'content',
        'user_id',
        'attachment_id'
    ];

    protected $appends = [
        'humanDate',
        'userInfo',
        'likesCount',
        'commentsCount',
        'liked',
        'attachmentUrl',
        'liked',
    ];

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

    public function attachment () {
        return $this->hasMany(Attachment::class);
    }

    //TODO:
    public function getAttachmentUrlAttribute () {
        if ($this->attachment()->first()) {
            $path = $this->attachment()->first()->attachment_path;
            return URL::asset("uploads/attachments/$path");
        }
        return null;
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

    public function getLikedAttribute () {
        $liked = Like::where([
            'post_id' => $this->id,
            'user_id' => Auth::user()->id
        ])->get();
        if ($liked->count()) {
            return true;
        }
        return false;
    }
}
