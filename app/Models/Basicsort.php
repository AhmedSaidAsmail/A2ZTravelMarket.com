<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basicsort extends Model {

    protected $fillable = [
        'name',
        'title',
        'status',
        'top_list',
        'arrangement',
        'img',
        'keywords',
        'description',
        'language',
        'currency',
        'time',
        'code',
        'best_time'];

    public function sorts() {
        return $this->hasMany(\App\Models\Sort::class);
    }


    public function delete() {
        $this->sorts()->delete();
        return parent::delete();
    }

}
