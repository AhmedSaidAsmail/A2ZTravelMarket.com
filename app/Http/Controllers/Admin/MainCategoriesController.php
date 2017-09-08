<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Src\Facades\UploadFacades;
use App\Models\Basicsort as Countries;

class MainCategoriesController extends Controller {

    protected $_instance;
    protected $_path = "/images/basicsorts/";

    public function __construct() {


        if (is_null($this->_instance)) {
            $this->_instance = \App\Http\Controllers\Admin\CategoriesController::class;
        }
    }

    public function index() {
        $Bsorts = Countries::all();
        return view('Admin.0_MainCategory', ['Bsorts' => $Bsorts, 'activeMaincategory' => 1]);
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        $this->itValidate($request);
        $item = $request->all();
        if ($request->hasFile('img')) {
            $file = Input::file('img');
            $item['img'] = UploadFacades::Upload($file, $this->_path, 250);
        }
        try {
            Countries::create($item);
        } catch (\Exception $e) {
            UploadFacades::removeImg();
            $request->session()->flash('errorDetails', $e->getMessage());
            $request->session()->flash('errorMsg', "Oops something went wrong !!");
        }
        return redirect()->route('MainCategory.index')->with('success', $request->name . ' has been inserted');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $basicSort = Countries::find($id);
        return view('Admin.1_MainCategory_update', ['basicSort' => $basicSort, 'activeMaincategory' => true]);
    }

    public function update(Request $request, $id) {
        $this->itValidate($request);
        $item = $request->all();
        $Maincategory = Countries::find($id);
        $exImg = $Maincategory->img;
        $this->changeImage($request, $item);
        try {
            $Maincategory->update($item);
            (isset($exImg) && $request->hasfile('img')) ? UploadFacades::removeExImg($exImg, $this->_path) : '';
        } catch (\Exception $e) {
            UploadFacades::removeImg();
            $request->session()->flash('errorDetails', $e->getMessage());
            $request->session()->flash('errorMsg', "Oops something went wrong !!");
        }

        return redirect()->route('MainCategory.index')->with('success', $request->name . ' has been updated');
    }

    public function destroy($id) {
        $MainCategory = Basicsort::find($id);
        $exImg = $MainCategory->img;
        $_instance = new $this->_instance;
        // to dlete all sub Categories and it's Items
        foreach ($MainCategory->sorts as $category) {
            $_instance->destroy($category->id);
        }
        $MainCategory->delete();
        (isset($exImg)) ? UploadFacades::removeExImg($exImg, $this->_path) : '';
        Session::flash('deleteStatus', "Main Category No: {$id} is Deleted !!");
        return redirect(route('MainCategory.index'));
    }

    private function itValidate(Request $request) {
        return $this->validate($request, [
                    'name' => 'required',
                    'title' => 'required',
                    'arrangement' => 'required|integer',
                    'img' => 'image',
                    'language' => 'required',
                    'currency' => 'required',
                    'time' => 'required',
                    'code' => 'required',
                    'best_time' => 'required'
        ]);
    }

    private function changeImage(Request $request,array &$items) {
        if ($request->hasFile('img')) {
            $file = Input::file('img');
            $items['img'] = UploadFacades::Upload($file, $this->_path, 250);
        }
    }

}
