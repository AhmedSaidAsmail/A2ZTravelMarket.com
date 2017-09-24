<?php

namespace App\Http\Controllers\Auth_Supplier;

use App\Supplier;
use Illuminate\Http\Request;
//use Validator;
use App\Http\Controllers\Controller;

//use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller {

    protected $redirectTo = '/';

    public function __construct() {
        $this->middleware('guest');
    }

    public function register(Request $request) {
        $this->validator($request);
        $this->create($request);
        return redirect()->route('supplier.login');
    }

    protected function validator(Request $request) {
        return $this->validate($request, [
                    'f_name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:suppliers',
                    'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(Request $request) {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['confirm']=1; 
        return Supplier::create($data);
    }

}
