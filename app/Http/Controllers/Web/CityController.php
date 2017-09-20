<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Sort;

class CityController extends Controller {

    public function show($id) {
        $city = Sort::find($id);
        $country=$city->basicsort;
        $attractions=$city->attractions()->where('status',1)->get();
        $items = $city->items()->where([['items.status', 1],['deleted', 0]])->orderBy('arrangement')->limit(4)->get();
        return view('Web.8_City_show', ['city' => $city,'attractions'=>$attractions,'items'=>$items,'country'=>$country]);
    }

}
