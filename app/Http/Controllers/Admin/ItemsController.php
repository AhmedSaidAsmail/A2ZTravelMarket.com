<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyModels\Admin\Item;
use Illuminate\Support\Facades\Input;
use App\Src\Facades\UploadFacades;
use Illuminate\Support\Facades\Session;

class ItemsController extends Controller {

    protected $_path = '/images/items/';
    public function index() {
        $Items = Item::all();
        return view('Admin.Items', ['Items' => $Items, 'activeItems' => 1]);
    }
    public function store(Request $request) {
        $this->validate($request, ['name'        => 'required',
            'sort_id'     => 'required',
            'title'       => 'required',
            'arrangement' => 'integer',
            'img'         => 'image']);
        $Item = $request->all();
        if ($request->hasFile('img')) {
            $file        = Input::file('img');
            $Item['img'] = UploadFacades::Upload($file, $this->_path, 250);
        }
        try {
            Item::create($Item);
        } catch (\Exception $e) {
            UploadFacades::removeImg();
            $request->session()->flash('errorDetails', $e->getMessage());
            $request->session()->flash('errorMsg', "Oops something went wrong !!");
        }
        return redirect(route('Items.index'));
    }
    public function edit($id) {
        $item = Item::find($id);
        if (!is_null($item)) {
            return view('Admin.ItemUpdate', ['Item' => $item, 'activeItems' => 1]);
        }
        Session::flash('fetchData', 'There is no such data');
        return redirect()->route('Items.index');
    }
    public function update($id, Request $request) {
        $this->validate($request, ['name'        => 'required',
            'sort_id'     => 'required',
            'title'       => 'required',
            'arrangement' => 'integer',
            'img'         => 'image']);
        $Item   = $request->all();
        $target = Item::find($id);
        $exImg  = $target->img;
        if ($request->hasFile('img')) {
            $file        = Input::file('img');
            $Item['img'] = UploadFacades::Upload($file, $this->_path, 250);
        }
        try {
            $target->update($Item);
            (isset($exImg) && $request->hasFile('img')) ? UploadFacades::removeExImg($exImg, $this->_path) : '';
        } catch (\Exception $e) {
            UploadFacades::removeImg();
            $request->session()->flash('errorDetails', $e->getMessage());
            $request->session()->flash('errorMsg', "Oops something went wrong !!");
        }
        return redirect(route('Items.index'));
    }
    public function destroy($id) {
        $target = Item::find($id);
        $target->delete();
        Session::flash('deleteStatus', "Item No: {$id} is Deleted !!");
        return redirect(route('Items.index'));
    }

}