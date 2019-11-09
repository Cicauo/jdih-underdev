<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	public function login(Request $request)
	{
		$rules = ['captcha' => 'required|captcha'];
		$validator = validator()->make(request()->all(), $rules);
		if ($validator->fails()) {
			\Session::flash('error', 'Captha tidak cocok');
			return redirect()->back();
		}
		if (Auth::attempt(['email' => $request->email, 'password' => base64_decode($request->password)])) {
			// Success
			return redirect()->intended('/home');
		} else {
			// Go back on error (or do what you want)
			\Session::flash('error', 'Email dan password tidak cocok');
			return redirect()->back();
		}

	}
	
	
}
