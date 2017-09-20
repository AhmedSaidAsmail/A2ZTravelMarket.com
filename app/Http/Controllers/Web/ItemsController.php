<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\VarsController as Vars;
use App\Http\Controllers\Web\WishlistController;
use App\Models\Item;
//use App\Wishlist;
use Auth;

class ItemsController extends Controller {

    public function show($city, $tour, $id) {
        $item = Item::find($id);
        $item->increment('visits');
        return view('Web.4_item_show', [
            'item' => $item,
            'tour' => $tour,
            'city' => $city,
            'recommended' => $this->getRecommendedTours($item),
            'wishlist' => $this->wishlistCheck($id)
        ]);
    }

    private function wishlistCheck($id) {
        if (Auth::guard('customer')->check()) {
            $customer_id = Auth::guard('customer')->user()->id;
            return WishlistController::checkWishlistItemExcite($id, $customer_id);
        }
        return WishlistController::checkWishlist($id);
    }

    public function getRecommendedTours($item) {
        $recommended = $item
                ->attraction
//                ->sort
                ->items()
                ->where('recommended', 1)->where('id', '!=', $item->id)
                ->orderBy('arrangement')
                ->limit(4)
                ->get();
        return $recommended;
    }

    public function showPrices(Request $request, $id) {
        $item = Item::find($id);
        $date = $request->date;
        $day = date('l', strtotime($date));
        $dates = $item->price()
                ->where([['status', 1], ['deleted', 0]])
                ->get();
        return view('Web.5_item_show_availability', [
            'item' => $item,
            'dates' => $dates,
            'day' => $day,
            'tourDate' => $date,
            'request' => $request
        ]);
    }

    public static function checkAvailability($price, $day) {
        if ($price->week_day == $day || $price->week_day == "all") {
            return TRUE;
        }
        return FALSE;
    }

    public static function getTotalPrice(Request $request, $price) {
        $total = self::getTotalPriceWithoutDiscount($request, $price);
        if ($price->discount > 0) {
            $totalAfter = self::getTotalAfterDiscount($total, $price->discount);
            return '<span class="discount-price"><label>' . Vars::getVar('€') . $total . '</label>' . Vars::getVar('€') . $totalAfter . '</span>';
        }
        return '<span>' . Vars::getVar('€') . $total . '</span>';
    }

    public static function getTotalPriceAmount(Request $request, $price) {
        $total = self::getTotalPriceWithoutDiscount($request, $price);
        if ($price->discount > 0) {
            $totalAfter = self::getTotalAfterDiscount($total, $price->discount);
            return $totalAfter;
        }
        return $total;
    }

    public static function getTotalAfterDiscount($price, $discount) {
        $discountValue = $price * $discount / 100;
        $total = $price - $discountValue;
        return $total;
    }

    public static function getTotalPriceWithoutDiscount(Request $request, $price) {
        $total = 0;
        $total += ($request->st_no * $price->st_price);
        $total += (!is_null($request->sec_no)) ? ($request->sec_no * $price->sec_price) : 0;
        $total += (!is_null($request->third_no)) ? ($request->third_no * $price->third_price) : 0;
        return number_format($total, 2, '.', '');
    }

    public static function getPricePlane($id) {
        $item = Item::find($id);
        $lowestPrice = $item->price()
                ->where('status', 1)
                ->where('deleted', 0)
                ->orderBy('st_price')
                ->first();
        return $lowestPrice;
    }

    public static function getDiscountSign($id) {
        $lowPriceRow = self::getPricePlane($id);
        if (!is_null($lowPriceRow) && $lowPriceRow->discount > 0) {
            return '<div class="discount-value">Save up to ' . $lowPriceRow->discount . '%</div>';
        }
    }

    public static function getLowestPrice($id) {
        $lowPriceRow = self::getPricePlane($id);
        if (!is_null($lowPriceRow)) {
            $lowestPrice = number_format($lowPriceRow->st_price, 2, '.', '');
            if ($lowPriceRow->discount > 0) {
                $discountValue = $lowestPrice * $lowPriceRow->discount / 100;
                $priceAfterDiscount = number_format($lowestPrice - $discountValue, 2, '.', '');
                return '
           <span id="price-discount">
                <label>' . Vars::getVar('€') . $lowestPrice . '</label>
                 ' . Vars::getVar('€') . $priceAfterDiscount . '
            </span>
';
            }
            return Vars::getVar('€') . number_format($lowPriceRow->st_price, 2, '.', '');
        }
        return Vars::getVar('€') . "0.00";
    }
        public static function getLowestPrice2($id) {
        $lowPriceRow = self::getPricePlane($id);
        if (!is_null($lowPriceRow)) {
            $lowestPrice = number_format($lowPriceRow->st_price, 2, '.', '');
            if ($lowPriceRow->discount > 0) {
                $discountValue = $lowestPrice * $lowPriceRow->discount / 100;
                $priceAfterDiscount = number_format($lowestPrice - $discountValue, 2, '.', '');
                return '
           <span class="price-after-desc">
                <label>' . Vars::getVar('€') . $lowestPrice . '</label>
                 ' . Vars::getVar('€') . $priceAfterDiscount . '
            </span>
';
            }
            return Vars::getVar('€') . number_format($lowPriceRow->st_price, 2, '.', '');
        }
        return Vars::getVar('€') . "0.00";
    }

}
