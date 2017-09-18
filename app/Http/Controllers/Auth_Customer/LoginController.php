<?php

namespace App\Http\Controllers\Auth_Customer;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
    }

//    public function showLoginForm() {
//
//        return view('auth_supplier.login');
//    }

    public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password,'confirm'=>1], $request->remember)) {
            return redirect()->back();
        }
//        return redirect()->back()->withInput($request->only('email','remember'));
        return redirect()->back()->with('failure', ' oops there\'s something wrong with the response');
    }


}
