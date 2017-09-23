<?php

namespace App;

class Cart {

    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $name;
    public $email;
    public $country;
    public $phone;
    public $customer_id;

    public function __construct($oldCart) {
        if (isset($oldCart)) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
            $this->name = $oldCart->name;
            $this->email = $oldCart->email;
            $this->country = $oldCart->country;
            $this->phone = $oldCart->phone;
            $this->customer_id = $oldCart->customer_id;
        }
    }

    public function add($item) {
        $this->totalQty++;
        $this->items[] = $item;
        $this->totalPrice += $item['price'];
    }

    public function remove($id) {
        if (isset($this->items) && array_key_exists($id, $this->items)) {
            $this->totalPrice -= $this->items[$id]['price'];
            $this->totalQty--;
            unset($this->items[$id]);
        }
    }

}
