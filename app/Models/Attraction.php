<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attraction extends Model {

    protected $fillable = [
        'sort_id',
        'name',
        'arrangement',
        'title',
        'txt',
        'status',
        'recommended',
        'keywords',
        'description',
        'img'];

    public function sort() {
        return $this->belongsTo(\App\Models\Sort::class);
    }

    public function items() {
        return $this->hasMany(\App\Models\Item::class);
    }

}
