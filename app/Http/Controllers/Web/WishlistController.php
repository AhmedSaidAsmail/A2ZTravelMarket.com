<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Wishlist;

class WishlistController extends Controller {

    public function addToCart(Request $request) {
        $oldWishlist = (Session::has('wishlist')) ? Session::get('wishlist') : null;
        $array = [
            'item_id' => $request->item_id
        ];
        $wishlist = new Wishlist($oldWishlist);
        $wishlist->add($array);
        $request->session()->put('wishlist', $wishlist);
    }

}
