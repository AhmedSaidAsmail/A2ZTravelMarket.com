<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model {

    protected $fillable = ['reservation_id', 'title', 'price', 'date', 'st_no', 'st_price', 'st_name', 'sec_no', 'sec_price', 'sec_name'];

    public function reservation() {
        return $this->belongsTo(App\MyModels\Admin\Reservation::class);
    }
    public function item(){
        return $this->belongsTo(\App\Models\Item::class);
    }
    public function price(){
        return $this->belongsTo(\App\Models\Price::class);
    }

}
