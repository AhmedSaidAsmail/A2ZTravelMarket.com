<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Supplier;

class SuppliersController extends Controller {

    public function index() {
        $suppliers = Supplier::all();
        return view('Admin.10_supplier_view', ['suppliers' => $suppliers]);
    }

    public function create() {
        
    }

    public function store(Request $request) {
        //
    }

    public function show($id) {
       $supplier= Supplier::find($id);
       return view('Admin.11_Supplier_preview',['supplier'=>$supplier]);
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        $supplier = Supplier::find($id);
        if (isset($request->cancel_confirm)) {
            $supplier->update(['confirm' => 0]);
            return redirect()->back();
        }
        $supplier->update(['confirm' => 1]);
        return redirect()->back();
    }

    public function destroy($id) {
        //
    }

}
