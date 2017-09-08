<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MyModels\Admin\Review;
use App\MyModels\Admin\Item;

class ReviewController extends Controller {

    public function index() {
        $reviews = Review::all();
        return view('Admin.AllReviews', ['reviews' => $reviews]);
    }

    public function store($item_id) {
        $item = Item::find($item_id);
        return view('Web.writeReview', ['item' => $item]);
    }
    public function edit(Request $request){
        $this->validate($request, [
            'item_id'=>'integer|required',
            'overall_rating'=>'integer|required'
        ]);
        $review=$request->all();
        Review::create($review);
        return redirect()->route('review.all')->with('success','Your_Review_has_been_Submited');
    }
    public function showAll(){
        $reviews= Review::where('confirm',1)->get();
        return view('Web.allReviews',['reviews'=>$reviews]);
    }

    public static function getRateStar($rate) {
        for ($i = 0; $i < 5; $i++) {
            if ($rate > .5) {
                echo '<i class="fa fa-star"></i>';
                $rate -= 1;
            } elseif ($rate == .5) {
                echo '<i class="fa fa-star-half-o"></i>';
                $rate -= .5;
            } else {
                echo '<i class="fa fa-star-o"></i>';
            }
        }
    }

}
