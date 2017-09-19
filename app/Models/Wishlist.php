<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable=['item_id','customer_id'];
    public function item(){
        return $this->belongsTo(\App\Models\Item::class);
    }
    public function customer(){
        return $this->hasOne(\App\Customer::class);
    }
}
