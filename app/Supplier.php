<?php

namespace App;

use App\User;

class Supplier extends User {

    protected $fillable = [
        'email',
        'password',
        'confirm',
        'title',
        'f_name',
        'l_name',
        'company',
        'address',
        'city',
        'state',
        'country',
        'phone',
        'fax',
        'website',
        'company_type',
        'service_offer'
    ];
    public function items(){
        return $this->hasMany(\App\Models\Item::class);
    }

}
