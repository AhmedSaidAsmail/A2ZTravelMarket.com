<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model {

    protected $fillable = [
        'customer_id',
        'name',
        'country',
        'email',
        'phone',
        'tours',
        'deposit',
        'paid',
        'total',
        'confirm',
        'paymentId',
        'admin_deleted'];

    public function customer() {
        return $this->belongsTo(\App\Customer::class);
    }

    public function ResTours() {
        return $this->hasMany(\App\Models\Tour::class);
    }

}
