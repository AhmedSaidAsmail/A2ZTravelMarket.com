<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topics_text extends Model {

    protected $fillable = ['topic_id', 'txt'];

    public function topic() {
        $this->belongsTo("App\Models\Topic");
    }

}
