<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model {

    protected $fillable = [
        'item_id',
        'status',
        'deleted',
        'st_price',
        'sec_price',
        'third_price',
        'private',
        'language',
        'capacity',
        'week_day',
        'starting_time',
        'discount'];

    public function item() {
        return $this->belongsTo(\App\Models\Item::class);
    }
    public function tours(){
        return $this->hasMany(\App\Models\Tour::class);
    }

}
