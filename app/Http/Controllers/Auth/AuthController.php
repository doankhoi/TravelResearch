<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * User login
     * @return Response
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Handle request login
     * @param  LoginRequest $request 
     * @param  Guard        $auth    
     * @return Response              
     */
    public function postLogin(LoginRequest $request, Guard $auth)
    {
        $logValue = $request->input('log');
        $logAccess = filter_var($logValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $throttles = in_array(ThrottlesLogins::class, class_uses_recursive(get_class($this)));

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            $message = "Đăng nhập vượt quá số lần quy định.";
            $alertClass = "alert-danger";
            return redirect()->back()->with(compact('message', 'alertClass'))->withInput();
        }

        $credentials = [
            $logAccess => $logValue,
            'password' => $request->input('password')
        ];

        if (!$auth->validate($credentials)) {
            if ($throttles) {
                $this->incrementLoginAttempts($request);
            }

            $message = "Tên đăng nhập hoặc mật khẩu không hợp lệ.";
            $alertClass = "alert-danger";
            return redirect()->back()->with(compact('message', 'alertClass'))->withInput();
        }

        $user = $auth->getLastAttempted();
        if ($user) {
            if ($throttles) {
                $this->clearLoginAttempts($request);
            }

            $auth->login($user, false);

            if ($request->session()->has('user_id')) {
                $request->session()->forget('user_id');
            }
        
            return redirect(route('top'));
        }
        
        $request->session()->put('user_id', $user->id);
        $message = "Tên đăng nhập hoặc mật khẩu không hợp lệ.";
        $alertClass = "alert-danger";
        return redirect()->back()->with(compact('message', 'alertClass'))->withInput();
    }
}
