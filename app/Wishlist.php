<?php

namespace App;

use Illuminate\Http\Request;

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
        $this->totalQty++;
        $this->items[] = $item;
    }

    public function remove($id) {
        if (isset($this->items) && array_key_exists($id, $this->items)) {
            $this->totalQty--;
            unset($this->items[$id]);
        }
    }

}
