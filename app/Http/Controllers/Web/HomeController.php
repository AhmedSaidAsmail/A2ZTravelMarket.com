<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\Attraction;
use App\Models\Sort;
use App\Models\Item;
// old
use App\MyModels\Admin\Topic;
use App\MyModels\Cart;
use App\MyModels\Admin\Transfer;
use App\Http\Controllers\Web\PaypalSettings;
use App\MyModels\Admin\Reservation;
use App\Http\Controllers\Web\Reservation as reservationController;
use App\Mail\bookingRminder;
use App\Mail\clientMailResponse;
use App\Http\Controllers\Admin\VarsController;
use App\Http\Controllers\Web\paybalPayment;

class HomeController extends Controller {

    protected $mail = "booking@hurghadawonders.com";

//    protected $info_mail;
//    protected $name;
//    protected $web;
//    protected $mob;
    public function welcome() {
        $topAttractions = Attraction::where('status', 1)->orderBy('recommended')->get();
        $moreAttraction = (count($topAttractions) > 9) ? TRUE : FALSE;
        $topCitis = Sort::where('status', 1)->orderBy('recommended')->get();
        $moreCity = (count($topCitis) > 9) ? TRUE : FALSE;
        return view('Web.1_welcome', [
            'topAttractions' => $topAttractions,
            'moreAttraction' => $moreAttraction,
            'topCitis' => $topCitis,
            'moreCity' => $moreCity
        ]);
    }
    public function topicsShow($topicName) {
        if (strtolower($topicName) == "home") {
            return redirect()->route('home');
        }
        $topic = urldecode($topicName);
        $topicFetch = Topic::where('name', $topic)->first();
        // transfer
        $dist_from = Transfer::select('dist_from')->distinct()->get();
        // category
        $category = Sort::where('recommended', 1)->first();
        // all categories
        $Categories = Sort::where('status', 1)->get();
        return view('Web.topicsShow', [
            'topic' => $topicFetch,
            'dist_from' => $dist_from,
            'category' => $category,
            'Categories' => $Categories]);

        //$topicName;
    }





    public function checkOut() {
        $oldCart = (Session::has('cart')) ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $transferExist = $cart->checkTransferExist();
        $transferTimes = $cart->checkTransferTimes();
        return view('Web.CheckOut', [
            'items' => $cart->items,
            'total' => $cart->totalPrice,
            'Categories' => $this->catgories(),
            'dist_from' => $this->get_dist_from(),
            'percent' => PaypalSettings::percentage(),
            'transferExist' => $transferExist,
            'transferTimes' => $transferTimes]);
    }

    public static function vars($word) {
        return $word . "test";
    }

    public function searchItems(Request $request) {
        $text = $request->text;
        $items = Item::where('name', 'like', '%' . $text . '%')
                ->orWhere('title', 'like', '%' . $text . '%')
                ->orWhere('intro', 'like', '%' . $text . '%')
                ->get();
        return view('Web.searchResult', ["items" => $items]);
    }

    public function finalCheckOut(Request $request) {
        $oldCart = (Session::has('cart')) ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $reservationController = new reservationController($cart);
        $reservation = $request->all();
        $reservation['tours'] = count($reservationController->getTours());
        $reservation['transfers'] = count($reservationController->getTransfers());
        $booking = Reservation::create($reservation);
        $booking_id = $booking->id;
        $reservationController->InsertItems($booking_id);
        // if there no deposit
        if (PaypalSettings::percentage() > 0) {
            $payment = new paybalPayment($request->total, asset('booking-done'), $booking_id);
            $redirectLink = $payment->finalMethod();
            //dd($redirectLink);
            return redirect()->to($redirectLink);
        } else {
            $this->sendBookingMail($booking_id);
            $this->sendClentMail($request->name, $request->email);
            return redirect()->to(asset('booking-done?success=approval'));
        }
    }

    public function sendBookingMail($id) {
        Mail::to($this->mail)->send(new bookingRminder($id, $this->mail));
    }

    private function sendClentMail($name, $mail) {

        Mail::to($mail)->send(new clientMailResponse($name, VarsController::getVar('MyWebsite'), VarsController::getVar('informaion_mail'), VarsController::getVar('iformation_mob'), $this->mail));
    }

    public function bookingDone(Request $request) {
        $approval = $request->success;
        if ($approval == 'approval') {
            $request->session()->forget('cart');
        }
        return view('Web.BookingDone', [
            'Categories' => $this->catgories(),
            'dist_from' => $this->get_dist_from(),
            'success' => $approval]);
    }

    public function getDays($id) {
        $daysOff = [];
        $weekDays = [0 => "Sunday", 1 => "Monday", 2 => "Tuesday", 3 => "Wednesday", 4 => "Thursday", 5 => "Friday", 6 => "Saturday"];
        $item = Item::find($id);
        if (isset($item->detail)) {
            $days = unserialize($item->detail->availability);
            $daysOff = array_diff($weekDays, $days);
            $returnDays = array_keys($daysOff);
            if (count($returnDays) > 0) {
                return json_encode($returnDays);
            } else {
                return json_encode(null);
            }
        } else {
            return null;
        }
    }

}
