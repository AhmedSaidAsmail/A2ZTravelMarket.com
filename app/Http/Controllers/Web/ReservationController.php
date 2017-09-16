<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Item;
use App\Cart;

class ReservationController extends Controller {

    public function addToCart(Request $request) {
        $this->validate($request, [
            'date' => 'required',
            'st_no' => 'required|integer'
        ]);
        $oldCart = (Session::has('cart')) ? Session::get('cart') : null;
        $itemCart = [
            'item' => $request->item_id,
            'price_id' => $request->price_id,
            'price' => $request->price,
            'date' => $request->date,
            'st_no' => (int) $request->st_no,
            'sec_no' => (int) $request->sec_no,
            'third_no' => $request->third_no,
            'discount'=>$request->discount
        ];
        $cart = new Cart($oldCart);
        $cart->add($itemCart);
        $request->session()->put('cart', $cart);
        return redirect()->back();
//        return redirect()->route('cart');
    }

}
