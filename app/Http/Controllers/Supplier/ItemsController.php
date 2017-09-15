<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Src\Facades\UploadFacades;
use App\Models\Item;

class ItemsController extends Controller {

    protected $_path = '/images/items/';

    public function index() {
        return view('Supplier.0_Items', ['activeItems' => 1]);
    }

    public function store(Request $request) {
        $this->itValidate($request);
        $item = $request->all();
        $this->changeImage($request, $item);
        try {
            Item::create($item);
        } catch (\Exception $e) {
            UploadFacades::removeImg();
            $request->session()->flash('errorDetails', $e->getMessage());
            $request->session()->flash('errorMsg', "Oops something went wrong !!");
        }
        return redirect()->route('suItems.index')->with('success', $request->name . ' has been created');
    }

    public function edit($id) {
        $item = Item::find($id);
        $price_def = $item->price_definition;
        if (Auth::user()->id != $item->supplier_id) {
            return redirect()->route('suItems.index')->with('failure', ' oops there\'s something wrong with the response');
        }
        if (!is_null($item)) {
            return view('Supplier.1_Items_update', ['Item' => $item, 'price_def' => $price_def, 'activeItems' => 1]);
        }
        Session::flash('fetchData', 'There is no such data');
        return redirect()->route('suItems.index');
    }

    public function update($id, Request $request) {
        $this->itValidate($request);
        $item = $request->all();
        $target = Item::find($id);
        $exImg = $target->img;
        $this->changeImage($request, $item);
        try {
            $target->update($item);
            (isset($exImg) && $request->hasFile('img')) ? UploadFacades::removeExImg($exImg, $this->_path) : '';
        } catch (\Exception $e) {
            UploadFacades::removeImg();
            return redirect()->route('suItems.index')->with('failure', $request->name . ' oops there\'s something wrong with the response');
        }
        return redirect()->route('suItems.index')->with('success', $request->name . ' has been updated');
    }

    public function destroy($id) {
        $target = Item::find($id);
        $target->delete();
        Session::flash('deleteStatus', "Item No: {$id} has been deleted Deleted !!");
        return redirect(route('Items.index'));
    }

    private function itValidate(Request $request) {
        return $this->validate($request, [
                    'attraction_id' => 'required|integer',
                    'supplier_id' => 'required|integer',
                    'cancellation' => 'required|integer',
                    'name' => 'required',
                    'title' => 'required',
                    'img' => 'image'
        ]);
    }

    private function changeImage(Request $request, array &$items) {
        if ($request->hasFile('img')) {
            $file = Input::file('img');
            $items['img'] = UploadFacades::Upload($file, $this->_path, 250);
        }
    }

}
