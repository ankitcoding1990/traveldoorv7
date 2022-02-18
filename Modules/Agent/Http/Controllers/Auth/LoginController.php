<?php

namespace Modules\Agent\Http\Controllers\Auth;

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
        //$this->middleware('agent')->except('logout');
    }

    function showLoginForm(){
      return view('agent::auth.login');
    }

    function login(Request $request){
       $input = $request->all();
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
        ]);
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if(auth()->guard('agent')->attempt(array($fieldType => $input['name'], 'password' => $input['password'])))
        {
            return response(['status' => true, 'message' => 'Login successed', 'redirect' => route('agent.dashboard')],200);
        }else{
            return response(['status' => false, 'message' => 'Incorrect username or password'],200);
        }
    }

}
