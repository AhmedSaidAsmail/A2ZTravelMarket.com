<?php

namespace App;

class Wishlist {

    public $items = null;
    public $totalQty = 0;

    public function __construct($oldWishlist) {
        if (isset($oldWishlist)) {
            $this->items = $oldWishlist->items;
            $this->totalQty = $oldWishlist->totalQty;
        }
    }

    public function add($item) {

//        if (!is_null($this->items) && !in_array($item, $this->items)) {
            $this->totalQty++;
            $this->items[] = $item;
    }

    public function remove($id) {
        if (isset($this->items) && in_array($id, $this->items)) {
            $key = array_search($id, $this->items);
            $this->totalQty--;
            unset($this->items[$key]);
        }
    }

}
