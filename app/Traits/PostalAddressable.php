<?php
namespace App\Traits;

use App\PostalAddress;

trait PostalAddressable
{
    public function postalAddresses()
    {
        return $this->morphMany(PostalAddress::class, 'addressable');
    }
}
