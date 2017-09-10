<?php

namespace App\Http\Controllers;

use App\Models\Item;

class ReviewsRateCalculate {

    private $item_id;
    private $field;
    private $confirm;
    private $item;
    private $reviews_count;
    private $reviews_rate_sum;

    public function __construct($item_id, $field, $confirm = null) {
        $this->item_id = $item_id;
        $this->field = $field;
        $this->confirm = (!is_null($confirm)) ? $confirm : null;
        return $this;
    }

    public function setItem() {
        $this->item = Item::find($this->item_id);
        return $this;
    }

    public function setReviewsCount() {
        switch ($this->confirm) {
            case NULL:
                $this->reviews_count = $this->item->reviews()->where('confirm', 1)->count();
                break;
            case "all":
                $this->reviews_count = $this->item->reviews()->count();
                break;
        }

        return $this;
    }

    public function setReviewsRateSum() {

        switch ($this->confirm) {
            case NULL:
                $this->reviews_rate_sum = $this->item->reviews()->where('confirm', 1)->sum($this->field);
                break;
            case "all":
                $this->reviews_rate_sum = $this->item->reviews()->sum($this->field);
                break;
        }
        return $this;
    }

    public function getRate() {
        if ($this->reviews_count > 0) {
            $rate = $this->reviews_rate_sum / $this->reviews_count;
            return $this->roundRate($rate);
        }
        return 0;
    }

    public function roundRate($rate) {
        $x = floor($rate * 2) / 2;
        return $x;
    }

    public static function init($item_id, $field, $confirm = null) {
        return new static($item_id, $field, $confirm);
    }

    public static function calc($item_id, $field, $confirm = null) {
        return self::init($item_id, $field, $confirm)
                        ->setItem()
                        ->setReviewsCount()
                        ->setReviewsRateSum()
                        ->getRate();
    }

}
