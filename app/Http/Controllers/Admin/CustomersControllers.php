<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;

class CustomersControllers extends Controller {

    public function index() {
        $customers = Customer::all();
        return view('Admin.10_customers_view', ['customers' => $customers]);
    }

    public function create() {
        
    }

    public function store(Request $request) {
        //
    }

    public function show($id) {
       $customer = Customer::find($id);
       return view('Admin.11_Customer_preview',['customer'=>$customer]);
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        $customer = Customer::find($id);
        if (isset($request->cancel_confirm)) {
            $customer->update(['confirm' => 0]);
            return redirect()->back();
        }
        $customer->update(['confirm' => 1]);
        return redirect()->back();
    }

    public function destroy($id) {
        //
    }

}
