<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Services\Login\RememberMeExpiration;
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

    public function login(Request $request)

    {

        $input = $request->all();

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
      
    
        $credentials = $request->only('email', 'password');
      
        if (!Auth::attempt($credentials)) :
           return redirect()->route('user.login')->withInput()->with('error', "Login details are not valid.");

        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user, $request->get('remember'));

        if($request->get('remember')):
            $this->setRememberMeExpiration($user);
        endif;

        return $this->authenticated($request, $user);

    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('home');
       // return redirect()->intended($this->redirectPath());
    }
    // Redirect to the correct route after successful logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

}
