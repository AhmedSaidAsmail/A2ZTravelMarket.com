<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price_definition extends Model {

    public function item() {
        return $this->belongsTo(\App\Models\Item::class);
    }

}
