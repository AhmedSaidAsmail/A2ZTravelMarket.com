<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Src\Facades\UploadFacades;
use Auth;
use App\Models\Item;
use App\Models\Exploration;

class ExplorationController extends Controller {

    protected $_path = '/images/gallery/';

    public function index($itemID) {
        $item = Item::find($itemID);
        $explanation = $item->exploration;
        $return = view('Supplier.2_explanation_list', ['item' => $item, 'explanation' => $explanation]);
        return $this->supplierGuard($itemID, $return);
    }

    public function create($itemID) {
        $item = Item::find($itemID);
        $return = view('Supplier.3_explanation_create', ['item' => $item]);
        return $this->supplierGuard($itemID, $return);
    }

    public function store(Request $request, $itemID) {
        $this->itValidate($request);
        $data = $request->all();
        try {
            Exploration::create($data);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
        return redirect()->route('suItems.edit', ['itemID' => $itemID]);
    }

    public function show($itemId, $id) {
        $item = Item::find($itemId);
        $return = view('Admin.explanationDelete', ["Item" => $item, "rowID" => $id]);
        return $this->supplierGuard($itemId, $return);
    }

    public function edit($itemId, $id) {
        $prev = Exploration::findOrFail($id);
        $item = Item::find($itemId);
        $return = view('Supplier.4_explanation_edit', ['item' => $item, 'prev' => $prev]);
        return $this->supplierGuard($itemId, $return);
    }
    public function update(Request $request, $itemId, $id) {
        $this->itValidate($request);
        $target = Exploration::find($id);
        $data = $request->all();
        try {
            $target->update($data);
        } catch (\Exception $e) {
            UploadFacades::removeImg();
            $request->session()->flash('errorDetails', $e->getMessage());
            $request->session()->flash('errorMsg', "Oops something went wrong !!");
        }
        return redirect()->route("Exploration.index", [$itemId]);
    }

    public function destroy($itemId, $id) {
        $target = Exploration::find($id);
        $target->delete();
        Session::flash('deleteStatus', "Item No: {$id} is Deleted !!");
        return redirect()->route("Exploration.index", [$itemId]);
    }

    private function itValidate(Request $request) {
        return $this->validate($request, [
                    'txt' => 'required|min:100'
        ]);
    }

    private function supplierGuard($item_id, $function) {
        $item = Item::find($item_id);
        if (Auth::user()->id != $item->supplier_id) {
            return redirect()->route('suItems.index')->with('failure', ' oops there\'s something wrong with the response');
        }
        return $function;
    }

}
