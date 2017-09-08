<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model {

    protected $fillable = ['item_id', 'txt', 'duration', 'started_at', 'ended_at', 'availability'];

    public function item() {
        $this->belongsTo('App\Models\Item');
    }

}
