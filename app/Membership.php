<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Ramsey\Uuid\Uuid;

class Membership extends Model
{
    protected $fillable = [
        'user_id', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTimestamps();
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->uuid = Uuid::uuid1();
        });
    }
}
