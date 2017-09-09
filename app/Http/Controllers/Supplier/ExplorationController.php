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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($itemID) {
        $item = Item::find($itemID);
        $explanation = $item->exploration;
        $this->supplierGuard($itemID);
        return view('Supplier.2_explanation_list', ['item' => $item, 'explanation' => $explanation]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($itemID) {
        return view('Admin.ExplorationCreate', ['itemID' => $itemID]);
//        return view('Admin.ExplorationCreate', ['itemID' => $itemID]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $itemID) {
        $this->validate($request, [
            'txt' => 'required|min:1',
            'img' => 'image'
        ]);
        $data = $request->all();
        $data ['txt'] = $request->txt;
        $data ['started_at'] = $request->started_at ? $request->started_at : null;
        $data ['ended_at'] = $request->ended_at ? $request->ended_at : null;
        $data['item_id'] = $itemID;
        if ($request->hasFile('img')) {
            $file = Input::file('img');
            $data['img'] = UploadFacades::Upload($file, $this->_path, 250);
        }
        try {
            Exploration::create($data);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

        return redirect()->route('Items.edit', ['itemID' => $itemID]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($itemId, $id) {
        $item = Item::find($itemId);
        return view('Admin.explanationDelete', ["Item" => $item, "rowID" => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($itemId, $id) {
        $item = Exploration::findOrFail($id);
        return view('Admin.explanationEdit', ['itemID' => $itemId, 'item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $itemId, $id) {
        $target = Exploration::find($id);
        $exImg = $target->img;
        $this->validate($request, [
            'txt' => 'required|min:1',
            'img' => 'image'
        ]);
        $data = $request->all();
        $data ['txt'] = $request->txt;
        $data ['started_at'] = $request->started_at ? $request->started_at : null;
        $data ['ended_at'] = $request->ended_at ? $request->ended_at : null;

        if ($request->hasFile('img')) {
            $file = Input::file('img');
            $data['img'] = UploadFacades::Upload($file, $this->_path, 250);
        }
        try {
            $target->update($data);
            (isset($exImg) && $request->hasFile('img')) ? UploadFacades::removeExImg($exImg, $this->_path) : '';
        } catch (\Exception $e) {
            UploadFacades::removeImg();
            $request->session()->flash('errorDetails', $e->getMessage());
            $request->session()->flash('errorMsg', "Oops something went wrong !!");
        }
        return redirect()->route("Exploration.index", [$itemId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($itemId, $id) {
        $target = Exploration::find($id);
        $exImg = $target->img;
        (isset($exImg) ) ? UploadFacades::removeExImg($exImg, $this->_path) : '';
        $target->delete();
        Session::flash('deleteStatus', "Item No: {$id} is Deleted !!");
        return redirect()->route("Exploration.index", [$itemId]);
    }

    private function supplierGuard($item_id) {
        $item = Item::find($item_id);
        try {
            if (Auth::user()->id != $item->supplier_id) {
                throw new \Exception('oops there\'s something wrong with the response');
            }
        } catch (\Exception $e) {
            return redirect()->route('suItems.index')->with('failure', $e->getMessage());
        }
    }

}
