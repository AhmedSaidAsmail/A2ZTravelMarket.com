<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Wishlist;
use App\Models\Wishlist as WishlistModel;
use Auth;

class WishlistController extends Controller {

    public function index() {
        $customerWishlist = null;
        $sessionWishlist = null;
        if (Auth::guard('customer')->check()) {
            $customerWishlist = Auth::guard('customer')->user()->wishlists;
        }
        if (Session::has('wishlist')) {
            $oldWishlist = Session::get('wishlist');
            $wishlist = new Wishlist($oldWishlist);
            $sessionWishlist = $wishlist->items;
        }
        return view('Web.7_wishlist_show', ['sessionWishlist' => $sessionWishlist, 'customerWishlist' => $customerWishlist]);
    }

    public function addToWishlist(Request $request) {
        $item = $request->item_id;
        $customer_id = $request->customer_id;
        if (!empty($customer_id)) {
            $this->addToWishlistModel($item, $customer_id);
        } else {
            $this->addToWishlistSesseion($request, $item);
        }
        return redirect()->back();
    }

    private function addToWishlistSesseion(Request $request, $item) {
        $oldWishlist = (Session::has('wishlist')) ? Session::get('wishlist') : null;
        $wishlist = new Wishlist($oldWishlist);
        $wishlist->add($item);
        $request->session()->put('wishlist', $wishlist);
    }

    private function addToWishlistModel($item, $customer_id) {
        WishlistModel::create(['customer_id' => $customer_id, 'item_id' => $item]);
    }

    public function removeFromWishlist(Request $request) {
        $item = $request->item_id;
        $customer_id = $request->customer_id;
        if (!empty($customer_id)) {
            $this->removeFromWishlistModel($item, $customer_id);
        } else {
            $this->removeFromWishlistSesseion($request, $item);
        }

        return redirect()->back();
    }

    private function removeFromWishlistSesseion(Request $request, $item) {
        $oldWishlist = (Session::has('wishlist')) ? Session::get('wishlist') : null;
        $wishlist = new Wishlist($oldWishlist);
        $wishlist->remove($item);
        $request->session()->put('wishlist', $wishlist);
    }

    private function removeFromWishlistModel($item, $customer_id) {
        $record = WishlistModel::where('item_id', $item)->where('customer_id', $customer_id)->first();
        $record->delete();
    }

    public static function addPevWishlistAtLogin() {
        $oldWishlist = (Session::has('wishlist')) ? Session::get('wishlist') : null;
        if (!is_null($oldWishlist)) {
            $wishlist = new Wishlist($oldWishlist);
            $wishlistArray = $wishlist->items;
            $customer_id = Auth::guard('customer')->user()->id;
            foreach ($wishlistArray as $item_id) {
                if (!self::checkWishlistItemExcite($item_id, $customer_id)) {
                    WishlistModel::create(['customer_id' => $customer_id, 'item_id' => $item_id]);
                }
            }
        }
    }

    public static function checkWishlistItemExcite($item_id, $customer_id) {
        $record = WishlistModel::where('item_id', $item_id)->where('customer_id', $customer_id)->first();
        if (!is_null($record)) {
            return TRUE;
        }
        return FALSE;
    }

    public static function checkWishlist($id) {
        if (Session::has('wishlist')) {
            $oldWishlist = Session::get('wishlist');
            $wishlist = new Wishlist($oldWishlist);
            $array = !empty($wishlist->items) ? $wishlist->items : [];
            if (in_array($id, $array)) {
                return TRUE;
            }
        }
        return FALSE;
    }

    public static function customerWishlistCount() {
        $wishlistCount = Auth::guard('customer')->user()->wishlists->count();
        return $wishlistCount;
    }

}
