<?php
namespace App\Traits;

use App\Profile;

trait HasProfile
{
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function getProfileImgAttribute()
    {
        return '/img/' . $this->profile->profile_img;
    }

    public function getBackgroundImgAttribute()
    {
        return '/img/' . $this->profile->background_img;
    }

    public function getTitleAttribute()
    {
        return $this->profile->title;
    }

    public function getContentAttribute()
    {
        return $this->profile->content;
    }
}