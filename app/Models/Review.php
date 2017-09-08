<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {

    protected $fillable = [
        'item_id',
        'user_name',
        'user_email',
        'user_country',
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

}
