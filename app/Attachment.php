<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    public $timestamps = false;

    protected $fillable = ['post_id', 'attachment_path'];

    public function post () {
        return $this->belongsTo(Post::class);
    }
}
