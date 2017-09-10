<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

    protected $fillable = [
        'sort_id',
        'attraction_id',
        'supplier_id',
        'name',
        'arrangement',
        'title',
        'status',
        'recommended',
        'keywords',
        'description',
        'img',
        'intro',
        'visits',
        'deleted'];

    public function attraction() {
        return $this->belongsTo(\App\Models\Attraction::class);
    }

    public function supplier() {
        return $this->belongsTo(\App\Supplier::class);
    }

    public function price_definition() {
        return $this->hasOne(\App\Models\Price_definition::class);
    }

    public function price() {
        return $this->hasMany(\App\Models\Price::class);
    }

    public function exploration() {
        return $this->hasOne(\App\Models\Exploration::class);
    }

    public function inclusion() {
        return $this->hasMany(\App\Models\Inclusion::class);
    }

    public function exclusion() {
        return $this->hasMany(\App\Models\Exclusion::class);
    }

    public function additional() {
        return $this->hasMany(\App\Models\Additional::class);
    }

    public function itemsgallrie() {
        return $this->hasMany(\App\Models\Itemsgallrie::class);
    }

    public function reviews() {
        return $this->hasMany(\App\Models\Review::class);
    }
    public function tours(){
        return $this->hasMany(\App\Models\Tour::class);
    }

    public function delete() {
        $this->price()->delete();
        $this->price_definition()->delete();
        $this->exploration()->delete();
        $this->inclusion()->delete();
        $this->exclusion()->delete();
        $this->itemsgallrie()->delete();
        return parent::delete();
    }

}
