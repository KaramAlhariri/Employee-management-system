<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Concat;

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
    protected $maxAttempts = 3;
    protected $decayMinutes = 5;
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

            'username' => 'required',

            'password' => 'required',

        ]);

        $key = $this->throttleKey($request);

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        if($this->limiter()->tooManyAttempts($key,3)){
            return redirect()->route('login')

                ->with('error','re-try to login after '. (String) ceil($this->limiter()->availableIn($key)/60) ." minutes");
        }

        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'])))

        {

            return redirect()->route('home');

        }else{
            $this->limiter()->hit($key);
            return redirect()->route('login')

                ->with('error','Email-Address And Password Are Wrong.');

        }



    }


}
