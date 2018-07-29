<?php

namespace App;

use App\Traits\HasProfile;
use App\Traits\PostalAddressable;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasProfile;
    use Notifiable;
    use PostalAddressable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
//        'first_name',
        'gender',
//        'last_name',
        'country_code',
        'profile_id'
    ];

    protected $appends = [
        'background_img',
        'content',
        'profile_img',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
        'email'
    ];

    public function getRouteKeyName()
    {
        return 'name'; //username
    }

    public function threads()
    {
        return $this->hasMany(Thread::class)->latest();
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

//    public function membership()
//    {
//        return $this->hasOne(Membership::class);
//    }
//
//    public function merchants()
//    {
//        return $this->belongsToMany(Merchant::class)->withTimestamps();
//    }
//
//    public function revealPersonal()
//    {
//        $this->makeVisible('email');
//    }
//
//    public function getNameAttribute()
//    {
//        return $this->first_name . ' ' . $this->last_name;
//    }
}
