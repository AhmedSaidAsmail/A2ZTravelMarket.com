<?php

namespace App\Http\Controllers\Web;

use App\MyModels\Admin\Item;

class ReviewsRateCalculate {

    private $item_id;
    private $field;
    private $item;
    private $reviews_count;
    private $reviews_rate_sum;

    public function __construct($item_id, $field) {
        $this->item_id = $item_id;
        $this->field = $field;
        return $this;
    }
    public function setItem(){
        $this->item=Item::find($this->item_id);
        return $this;
    }
    public function setReviewsCount(){
        $this->reviews_count= $this->item->reviews()->where('confirm',1)->count();
        return $this;
    }
    public function setReviewsRateSum(){
        $this->reviews_rate_sum=$this->item->reviews()->where('confirm',1)->sum($this->field);
        return $this;
    }
    public function getRate(){
        $rate=$this->reviews_rate_sum/$this->reviews_count;
        return $this->roundRate($rate);
    }
    public function roundRate($rate){
        $x = floor($rate * 2) / 2;
        return $x;
    }

    public static function init($item_id, $field){
        return new static($item_id, $field);
    }

    public static function calc($item_id, $field) {
        return self::init($item_id, $field)
                ->setItem()
                ->setReviewsCount()
                ->setReviewsRateSum()
                ->getRate();
    }

}
