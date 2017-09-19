<?php

namespace App;

use App\User;

class Customer extends User {

    protected $fillable = [
        'email',
        'password',
        'confirm',
        'name',
        'address',
        'city',
        'state',
        'country',
        'phone'
    ];

    public function reveiws() {
        return $this->hasMany(\App\Models\Review::class);
    }

    public function reservations() {
        return $this->hasMany(\App\Models\Reservation::class);
    }
    public function wishlists(){
        return $this->hasMany(\App\Models\Wishlist::class);
    }

}
