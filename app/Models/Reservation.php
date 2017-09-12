<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model {

    protected $fillable = [
        'customer_id',
        'name',
        'country',
        'travel_agancy',
        'email', 'hotel',
        'mobile',
        'arrival_date',
        'departure_date',
        'tours',
        'deposit',
        'paid',
        'total',
        'arrival_flight_no',
        'arrival_flight_time',
        'departure_flight_no',
        'departure_flight_time',
        'confirm',
        'admin_deleted'];

    public function customer() {
        return $this->belongsTo(\App\Customer::class);
    }

    public function tours() {
        return $this->hasMany(\App\Models\Tour::class);
    }

}
