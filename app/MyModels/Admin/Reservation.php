<?php
namespace App\MyModels\Admin;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model {

    protected $fillable = ['name', 'country', 'travel_agancy', 'email', 'hotel', 'mobile', 'arrival_date', 'departure_date', 'tours', 'transfers', 'deposit', 'paid', 'total'
        , 'arrival_flight_no', 'arrival_flight_time', 'departure_flight_no', 'departure_flight_time'];
    public function selfTours() {
        return $this->hasMany(Tour::class);
    }
    public function selfTransfers() {
        return $this->hasMany(res_transfer::class);
    }

}