<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price_definition extends Model {

    protected $fillable = ['item_id', 'st_price_name', 'sec_price_name', 'third_price_name'];

    public function item() {
        return $this->belongsTo(\App\Models\Item::class);
    }

}
