<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    protected $fillable = [
        'user_id',
        'followed_id',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function isFollowed ($followed_id) {
    	return self::where([
            'user_id' => Auth::user()->id,
            'followed_id' => $followed_id
        ])->get();
    }

}
