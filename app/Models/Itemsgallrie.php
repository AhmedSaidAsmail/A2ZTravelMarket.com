<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Itemsgallrie extends Model {

    protected $fillable = ['item_id', 'img'];

    public function item() {
        $this->belongsTo('App\Models\Item');
    }

}
