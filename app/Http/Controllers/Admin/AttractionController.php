<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Src\Facades\UploadFacades;
use App\Models\Attraction;

class AttractionController extends Controller {

    protected $_instance;
    protected $_path = '/images/attraction/';

    public function __construct() {
        if (is_null($this->_instance)) {
            $this->_instance = \App\Http\Controllers\Admin\ItemsController::class;
        }
    }

    public function index() {
        $attraction = Attraction::all();
        return view('Admin.4_Attraction', ['attractions' => $attraction, 'activeCategory' => true]);
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        $this->itValidate($request);
        $item = $request->all();
        $this->changeImage($request, $item);
        try {
            Attraction::create($item);
        } catch (\Exception $e) {
            UploadFacades::removeImg();
            $request->session()->flash('errorDetails', $e->getMessage());
            $request->session()->flash('errorMsg', "Oops something went wrong !!");
        }
        return redirect()->route('Attraction.index')->with('success', $request->name . ' has been inserted');
    }



    public function edit($id) {
        $attraction = Attraction::findOrFail($id);
        return view('Admin.5_Attraction_update', ['attraction' => $attraction, 'activeCategory' => true]);
    }

    public function update(Request $request, $id) {
        $this->validate($request, ['name' => 'required',
            'basicsort_id' => 'required',
            'title' => 'required',
            'arrangement' => 'integer',
            'img' => 'image']);
        $Sort = $request->all();
        $category = Sort::findOrFail($id);
        $exImg = $category->img;
        if ($request->hasFile('img')) {
            $file = Input::file('img');
            $Sort['img'] = UploadFacades::Upload($file, $this->_path, 250);
        }
        try {
            $category->update($Sort);
            (isset($exImg) && $request->hasFile('img')) ? UploadFacades::removeExImg($exImg, $this->_path) : '';
        } catch (\Exception $e) {
            UploadFacades::removeImg();
            $request->session()->flash('errorDetails', $e->getMessage());
            $request->session()->flash('errorMsg', "Oops something went wrong !!");
        }
        return redirect(route('Category.index'));
    }

    public function destroy($id) {
        $Category = Sort::findOrFail($id);
        $exImg = $Category->img;
        $_instance = new $this->_instance;
        foreach ($Category->items as $item) {
            $_instance->destroy($item->id);
        }
        try {
            $Category->delete();
            Session::flash('deleteStatus', "Category No: {$id} is Deleted !!");
            (isset($exImg)) ? UploadFacades::removeExImg($exImg, $this->_path) : '';
        } catch (\Exception $e) {
            Session::flash('deleteStatus', $e->getMessage());
        }
        return redirect(route('Category.index'));
    }

    private function itValidate(Request $request) {
        return $this->validate($request, [
                    'sort_id' => 'required|integer',
                    'name' => 'required',
                    'title' => 'required',
                    'arrangement' => 'required|integer',
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
