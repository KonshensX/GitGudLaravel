<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    protected $fillable = ['user_id', 'post_id'];
    public $timestamps = false;

    public function post () {
        return $this->belongsTo(Post::class);
    }

}
