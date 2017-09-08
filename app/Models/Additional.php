<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Additional extends Model {

    protected $fillable = ['item_id', 'txt'];

    public function item() {
        $this->belongsTo('App\Models\Item');
    }

}
