<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Review;

class ReviewsController extends Controller {

    public function index($item_id = null) {
        if (!is_null($item_id)) {
            $item = Item::find($item_id);
            $reveiws = $item->reviews;
            return view('Admin.8_Reviews_all', ['item' => $item, 'reviews' => $reveiws]);
        }
        $reveiws = Review::all();
        return view('Admin.8_Reviews_all', ['reviews' => $reveiws]);
    }

    public function show($id) {
        $review = Review::find($id);
        return view('Admin.9_Reviews_one', ['review' => $review]);
    }

    public function update($id) {
        $review = Review::find($id);
        $review->update(['confirm' => 1]);
        return redirect()->back();
    }

    public function destroy($id) {
        $review = Review::find($id);
        $review->delete();
        return redirect()->back();
    }

}
