<?php

namespace App\Http\Controllers\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\CustomException;
use Auth;
use App\Models\Item;

class ItemDetailsController extends Controller {

    protected $_model = "\App\Models\\";

    protected function checkModel($model) {
        $this->_model .= ucfirst($model);
        if (!class_exists($this->_model)) {
            throw new CustomException("Oops This {$model}  is Not a Model");
        }
        return $this->_model;
    }

    public function create(Request $request, $item) {
        $this->validate($request, [
            'modelName' => 'required'
        ]);
        $this->checkModel($request->modelName);
        $Item = Item::find($item);
        $return= view('Supplier.5_Items_Details_Create', ['Item' => $Item, 'modelName' => $request->modelName]);
        return $this->supplierGuard($item, $return);
    }

    public function store(Request $request, $itemID) {
        $this->validate($request, [
            'modelName' => 'required',
            'text.*' => 'required|min:1'
        ]);
        $this->checkModel($request->modelName);
        $data = [];
        $data['item_id'] = $itemID;
        $modelName = "\App\Models\\" . ucfirst($request->modelName);
        foreach ($request->text as $text) {
            $data['txt'] = $text;
            $modelName::create($data);
        }
        return redirect()->route('suItems.edit', ['item' => $itemID]);
    }

    public function edit(Request $request, $itemID, $rowID) {
        $Item = Item::find($itemID);
        $model = $this->checkModel($request->modelName);
        $data = $model::find($rowID);
        $return= view('Supplier.6_Items_Details_Edit', ['Data' => $data, 'Item' => $Item, 'modelName' => $request->modelName]);
        return $this->supplierGuard($itemID, $return);
    }

    public function update(Request $request, $itemID, $rowID) {
        $updatedData = [];
        $model = $this->checkModel($request->modelName);
        $data = $model::find($rowID);
        $updatedData['txt'] = $request->text;
        $data->update($updatedData);
        return redirect()->route('suItems.edit', ['item' => $itemID]);
    }

    public function show(Request $request, $itemID, $rowID) {
        $item = Item::find($itemID);
        return view('Admin.ItemDetailDelete', ['rowID' => $rowID, 'Item' => $item, 'modelName' => $request->modelName]);
    }

    public function destroy(Request $request, $itemID, $rowID) {
        $model = $this->checkModel($request->modelName);
        $detail = $model::find($rowID);
        $detail->delete();
        return redirect()->route('suItems.edit', ['Item' => $itemID]);
    }

    private function supplierGuard($item_id, $function) {
        $item = Item::find($item_id);
        if (Auth::user()->id != $item->supplier_id) {
            return redirect()->route('suItems.index')->with('failure', ' oops there\'s something wrong with the response');
        }
        return $function;
    }

}
