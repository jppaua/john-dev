<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'content',
        'title',
        'profile_img',
        'background_img'
    ];
}
