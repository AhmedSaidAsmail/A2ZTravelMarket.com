<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Cart;
use App\Models\Reservation;
use App\Models\Tour;
use App\Mail\bookingRminder;
use App\Mail\clientMailResponse;
use App\Http\Controllers\Admin\VarsController;
use Auth;

class ReservationController extends Controller {

    private $mail = "test@sharm4all.com";

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
            'discount' => $request->discount
        ];
        $cart = new Cart($oldCart);
        $cart->add($itemCart);
        $request->session()->put('cart', $cart);
        return redirect()->route('reservation.cart.show');
    }

    public function showCart() {
        $oldCart = (Session::has('cart')) ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        return view('Web.6_reservation_cart', [
            'qty' => $cart->totalQty,
            'items' => $cart->items,
            'total' => $cart->totalPrice]);
    }

    public function removeFromCart(Request $request, $id) {
        $oldCart = (Session::has('cart')) ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($id);
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function showSheckoutForm() {
        $oldCart = (Session::has('cart')) ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $customer = Auth::guard('customer')->check() ? Auth::guard('customer')->user() : null;
        return view('Web.16_reservation_cart_checkout', [
            'items' => $cart->items,
            'total' => $cart->totalPrice,
            'customer' => $customer
        ]);
    }

    public function proceedPayment(Request $request) {
        $oldCart = (Session::has('cart')) ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $this->updateCart($request, $cart);
        $payment = new paybalPayment($request->total, route('reservation.final'));
        $redirectLink = $payment->finalMethod();
        return redirect()->to($redirectLink);
    }

    public function finalProceed(Request $request) {
        $oldCart = (Session::has('cart')) ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        if ($request->success == "approval") {
            $id = $this->reservationCreate($request, $cart);
            $this->toursCreate($id, $cart->items);
            $this->sendBookingMail($id)->sendClentMail($cart->name, $cart->email);
            $request->session()->forget('cart');
            return redirect()->route('reservation.final.success', ['paymentId' => $request->paymentId]);
        }

        return redirect()->route('reservation.final.false');
    }

    public function proceedSuccess($paymentId=null) {
        if (isset($paymentId)) {
            return view('Web.17_reservation_success', ['paymentId' => $paymentId]);
        }
        return redirect()->route('reservation.final.false');
    }

    public function proceedFalse() {
        return view('Web.18_reservation_false');
    }

    private function reservationCreate(Request $request, Cart $cart) {
        $data = get_object_vars($cart);
        $data["paymentId"] = $request->paymentId;
        $data["total"] = $data["deposit"] = $data["totalPrice"];
        $data["paid"] = 1;
        $data["tours"] = count($cart->items);
        $reeservation = Reservation::create($data);
        return $reeservation->id;
    }

    private function toursCreate($id, $tours) {
        foreach ($tours as $val) {
            $val["reservation_id"] = $id;
            $val["item_id"] = $val["item"];
            Tour::create($val);
        }
    }

    private function updateCart(Request $request, Cart $cart) {

        $CartVars = get_object_vars($cart);

        foreach ($CartVars as $key => $val) {
            if (isset($request->$key)) {
                $cart->$key = $request->$key;
            }
        }
        $request->session()->put('cart', $cart);
    }

    public function sendBookingMail($id) {
        Mail::to($this->mail)->send(new bookingRminder($id, $this->mail));
        return $this;
    }

    private function sendClentMail($name, $mail) {

        Mail::to($mail)
                ->send(new clientMailResponse($name, VarsController::getVar('MyWebsite'), VarsController::getVar('informaion_mail'), VarsController::getVar('iformation_mob'), $this->mail));
    }

}
