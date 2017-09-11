<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Item;

class ItemsController extends Controller {

    public function index() {
        $Items = Item::where('deleted', 0)->get();
        return view('Admin.6_Items', ['Items' => $Items, 'activeItems' => true]);
    }

    public function edit($id) {
        $item = Item::find($id);
        $price_def = $item->price_definition;
        if (!is_null($item)) {
            return view('Admin.7_Items_update', ['Item' => $item, 'price_def' => $price_def, 'activeItems' => 1]);
        }
        Session::flash('fetchData', 'There is no such data');
        return redirect()->back();
    }

    public function update($id, Request $request) {
        $Item = $request->all();
        $target = Item::find($id);
        try {
            $target->update($Item);
        } catch (\Exception $e) {
            $request->session()->flash('errorDetails', $e->getMessage());
            $request->session()->flash('errorMsg', "Oops something went wrong !!");
        }
        return redirect()->back();
    }

    public function destroy($id) {
        $target = Item::find($id);
        $target->update(['deleted' => 1]);
        Session::flash('deleteStatus', "Item No: {$id} is Deleted !!");
        return redirect(route('Items.index'));
    }

    public function itemReviews($item_id) {
        $item = Item::find($item_id);
        $reveiws=$item->reviews;
        return view('Admin.8_Reviews_all',['item'=>$item,'reviews'=>$reveiws]);
    }

}
