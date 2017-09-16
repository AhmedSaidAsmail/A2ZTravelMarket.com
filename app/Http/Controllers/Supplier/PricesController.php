<?php

namespace App\Http\Controllers\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Price;

class PricesController extends Controller {

    public function store(Request $request) {
        $this->validate($request, [
            'item_id' => 'required|integer',
            'st_price' => 'required|integer',
            'sec_price' => 'required|integer',
            'third_price' => 'integer',
            'week_day' => 'required',
            'starting_time' => 'required'
        ]);
        $data = $request->all();


        $new_data = array_map(function($value) {
            return (empty($value)) ? null : $value;
        }, $data);
        try {
            Price::create($new_data);
        } catch (\Exception $e) {
            return redirect()->route('suItems.edit', ['id' => $request->item_id])->with('error', $e->getMessage());
        }
        return redirect()->route('suItems.edit', ['id' => $request->item_id]);
    }

    public function update(Request $request, $id) {
        $data = Price::findOrFail($id);
        $status = $request['status'];
        $data->update(['status' => $status]);
        return redirect()->back();
    }

    public function updateDiscount(Request $request, $id) {
        $data = Price::findOrFail($id);
        $discount = $request->discount;
        $data->update(['discount' => $discount]);
        return redirect()->back();
    }

    public function destroy($id) {
        $data = Price::findOrFail($id);
        $data->update(['deleted' => 1]);
        return redirect()->back();
    }

}
