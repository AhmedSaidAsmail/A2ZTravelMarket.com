<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sort extends Model {

    protected $fillable = [
        'basicsort_id',
        'name',
        'arrangement',
        'title',
        'txt',
        'status',
        'recommended',
        'keywords',
        'description',
        'img'];

    public function basicsort() {
        return $this->belongsTo(\App\Models\Basicsort::class);
    }
    public function attractions() {
        return $this->hasMany(\App\Models\Attraction::class);
    }
    public function items() {
        return $this->hasManyThrough(\App\Models\Item::class, \App\Models\Attraction::class);
    }

    public function delete() {
        $this->items()->delete();
        return parent::delete();
    }

}
