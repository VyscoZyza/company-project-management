<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ]);
        // $rules =  [
        //     'email' => 'required|email',
        //     'password' => 'required',
        //     'captcha' => 'required|captcha'
        // ];
        // $messages = [
        //     'password.required'      => 'Password wajib diisi.',
        //     'email.required'         => 'Email wajib diisi.',
        //     'email.email'            => 'Email tidak valid.',
        //     'captcha.required'       => 'Captcha wajib diisi',
        //     'captcha.captcha'        => 'Captcha tidak valid',
        // ];
        // $validator = Validator::make($request->all(), $rules, $messages);
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput($request->all());
        // }


        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            if (auth()->user()->level == 00) {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('home.index');
            }
        } else {
            return redirect()->route('login')
                ->with('error', 'Email atau Password salah');
        }
        return redirect()->route('login')
            ->with('error', 'Captcha tidak Valid');
    }
}
