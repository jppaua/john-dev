<?php

namespace App;

use App\Traits\HasProfile;
use App\Traits\PostalAddressable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchant extends Model
{
    use HasProfile;
    use PostalAddressable;
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name', 
        'country_code',
        'profile_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // what does it mean to ask for an email address for a merchant? The first admin? set a primary contact account?
    // public function getEmailAttribute()
    // {
    //     return $this->users()->first()->email;
    // }
}
