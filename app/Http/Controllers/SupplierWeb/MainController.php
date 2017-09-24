<?php

namespace App\Http\Controllers\SupplierWeb;

use App\Http\Controllers\Controller;

class MainController extends Controller {

    public function index() {
        return view('SupplierWeb.Welcome');
    }

    public function showRegisterForm() {
        return view('SupplierWeb.registerForm');
    }

}
