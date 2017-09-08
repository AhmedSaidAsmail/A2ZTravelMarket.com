<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model {

    protected $fillable = [
        'item_id',
        'st_price',
        'sec_price',
        'third_price',
        'private',
        'language',
        'capacity',
        'week_day',
        'starting_time'];

    public function item() {
        return $this->belongsTo(\App\Models\Item::class);
    }

}
