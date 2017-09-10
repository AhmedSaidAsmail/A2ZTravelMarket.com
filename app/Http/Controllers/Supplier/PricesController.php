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
        $this->validate($request, [
            'st_price' => 'required|integer',
            'sec_price' => 'required|integer',
            'third_price' => 'integer',
            'week_day' => 'required',
            'starting_time' => 'required'
        ]);
        $data = Price::findOrFail($id);
        $update = $request->all();
        $new_data = array_map(function($value) {
            return (empty($value)) ? null : $value;
        }, $update);
        $data->update($new_data);
        return redirect()->back();
    }

    public function destroy($id) {
        $data = Price::findOrFail($id);
        $data->delete();
        return redirect()->back();
    }

}
