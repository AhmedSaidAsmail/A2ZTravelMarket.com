<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {

    protected $fillable = [
        'item_id',
        'customer_id',
        'overall_rating',
        'service_rating',
        'organization_rating',
        'value_rating',
        'safety_rating',
        'title',
        'review',
        'visit_sort',
        'visit_date',
        'confirm'];

    public function item() {
        return $this->belongsTo(\App\Models\Item::class);
    }

    public function customer() {
        return $this->belongsTo(\App\Customer::class);
    }

}
