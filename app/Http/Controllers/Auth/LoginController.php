<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    //for phone
    public function username()
    {
        return 'phone';
    }
    //Over write login view
    public function showLoginForm()
    {
        $setting = Setting::find(1);
        return view('auth.login',compact('setting'));
    }

    //Over write login
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if($this->guard()->validate($this->credentials($request))) {
            if(Auth::attempt(['phone' => $request->phone, 'password' => $request->password, 'status' => 1])) {
                Auth::user()->last_login_at = Carbon::now();
                Auth::user()->save();
                session()->flash('message', 'Login success.');
                session()->flash('type', 'success');
                //Admin
                if (Auth::user()->role == 'admin') {
                    return redirect(route('admin.dashboard.index'));
                }
                //Controller
                if(Auth::user()->role == 'controller'){
                    return redirect(route('controller.dashboard.index'));
                }
                //Worker
                if (Auth::user()->role == 'worker') {
                    return redirect(route('worker.home.index'));
                }
                //Membership
                if (Auth::user()->role == 'membership') {
                    return redirect(route('membership.home.index'));
                }
                //Customer
                if (Auth::user()->role == 'customer') {
                    return redirect(route('customer.home.index'));
                }
                //Unknown type
                else{
                    session()->flash('message', 'Non-permitted role.');
                    session()->flash('type', 'danger');
                    Auth::logout();
                    return redirect('/login');
                }
            }  else {
                $this->incrementLoginAttempts($request);
                session()->flash('message', 'This account is not activated.');
                session()->flash('type', 'warning');
                return redirect()->back();
            }
        } else {
            $this->incrementLoginAttempts($request);
            session()->flash('message', 'Credentials do not match our database.');
            session()->flash('type', 'warning');
            return redirect()->back();
        }
    }

}
