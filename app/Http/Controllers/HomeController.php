<?php

namespace App\Http\Controllers;

class HomeController extends Controller {

    public function index() {
        $current_date= time();
        return view('Admin.Welcome',[
            'current_date'=>$current_date
        ]);
    }

}
