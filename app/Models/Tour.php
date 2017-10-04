<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model {

    protected $fillable = [
        'reservation_id',
        'item_id',
        'price_id',
        'title', 
        'price', 
        'date', 
        'st_no', 
        'sec_no',
        'third_no',
        'supplier_deleted', 
        'confirm'];

    public function reservation() {
        return $this->belongsTo(App\Models\Reservation::class);
    }
    public function item(){
        return $this->belongsTo(\App\Models\Item::class);
    }
    public function itprice(){
        return $this->belongsTo(\App\Models\Price::class);
    }

}
