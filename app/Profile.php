<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'fullname', 'avatar_name', 'banner_name', 'location', 'about',
                           'birthdate'];

    //Get the user of the profile 
    public function user () {
        return $this->belongsTo(User::class);
    }
}
