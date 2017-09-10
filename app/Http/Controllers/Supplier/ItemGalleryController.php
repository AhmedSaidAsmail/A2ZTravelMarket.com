<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Src\Facades\UploadFacades;
use Auth;
use App\Models\Itemsgallrie;
use App\Models\Item;

class ItemGalleryController extends Controller {

    protected $_path = '/images/gallery/';

    public function index($item_id) {
        $item = Item::find($item_id);
        $images = $item->itemsgallrie;
        $return= view('Supplier.7_Items_Gallery_List', ['item' => $item, 'images' => $images]);
         return $this->supplierGuard($item_id, $return);
    }

    public function create($item_id) {
        $item = Item::find($item_id);
        $return= view('Supplier.8_Items_Gallery_Upload', ['item' => $item]);
        return $this->supplierGuard($item_id, $return);
    }

    public function store(Request $request, $item) {
        $data = [];
        $data['item_id'] = $item;
        $this->validate($request, [
            'file' => 'image'
        ]);
        if ($request->hasFile('file')) {
            $file = Input::file('file');
            $data['img'] = UploadFacades::Upload($file, $this->_path, 250);
        }
        Itemsgallrie::create($data);
    }

    public function destroy(Request $request, $itemID) {
        $this->validate($request, [
            'id' => 'required|min:1']);
        $images = $request->id;
        foreach ($images as $imageID) {
            try {
                $image = Itemsgallrie::findOrFail($imageID);
                $exImg = $image->img;
                $image->delete();
                (isset($exImg)) ? UploadFacades::removeExImg($exImg, $this->_path) : '';
            } catch (\Exception $e) {
                $request->session()->flash('errorDetails', $e->getMessage());
                $request->session()->flash('errorMsg', "Oops something went wrong !!");
            }
        }
        return redirect()->back();
    }

    private function supplierGuard($item_id, $function) {
        $item = Item::find($item_id);
        if (Auth::user()->id != $item->supplier_id) {
            return redirect()->route('suItems.index')->with('failure', ' oops there\'s something wrong with the response');
        }
        return $function;
    }

}
