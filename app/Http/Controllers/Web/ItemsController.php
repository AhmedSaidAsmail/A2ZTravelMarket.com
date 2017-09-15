<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemsController extends Controller {

    public function show($city, $tour, $id) {
        $item = Item::find($id);
        return view('Web.4_item_show', [
            'item' => $item,
            'tour' => $tour,
            'city' => $city
        ]);
    }

    public function showPrices(Request $request, $id) {
        return $id;
    }

}
