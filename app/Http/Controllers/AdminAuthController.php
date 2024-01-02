<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\Login\RememberMeExpiration;

class AdminAuthController extends Controller
{
    use RememberMeExpiration;
   
    public function showLoginForm()
    {
      /*  $user = User::create([
            'first_name' => "John Doe",
            'last_name' => "John Doe",
            'role' => "admin",
            'email' => 'tung@12g.co',
            'password' => bcrypt('123456'),
        ]);
        */
        return view('admin.auth-login-basic');
    }
    /*
    **
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    { 
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
      
    
        $credentials = $request->only('email', 'password');
      
        if (!Auth::attempt($credentials)) :
           return redirect()->route('admin.login')->withInput()->with('error', "Login details are not valid.");
          /*  return redirect()->to('login')
                ->withErrors(trans('auth.failed'));*/
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user, $request->get('remember'));

        if($request->get('remember')):
            $this->setRememberMeExpiration($user);
        endif;

        return $this->authenticated($request, $user);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|unique',
            'password' => 'required',


        ]);

    }


    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    // Redirect to the correct route after successful login
    protected function authenticated(Request $request, $user)
    {
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.dashboard');
       // return redirect()->intended($this->redirectPath());
    }
    // Redirect to the correct route after successful logout
    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('admin.login');
       
    }
}
