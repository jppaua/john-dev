<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostalAddress extends Model
{
    protected $hidden = [
        'addressable_type'
    ];

    public function addressable()
    {
        return $this->morphTo();
    }
}
