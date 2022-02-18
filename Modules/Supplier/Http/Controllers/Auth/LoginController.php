<?php

namespace Modules\Supplier\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;
    public function __construct()
    {
    }

    function showLoginForm(){
      return view('supplier::auth.login');
    }

    function login(Request $request){
       $input = $request->all();
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
        ]);
        
        $fieldType = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        if(Auth::guard('supplier')->attempt(array($fieldType => $input['name'], 'password' => $input['password'])))
        {
            // dd(auth()->guard()->user()->checkActiveSupplie);
            return response(['status' => true, 'message' => 'Login successed', 'redirect' => route('supplier.dashboard')],200);
        }else{
            return response(['status' => false, 'message' => 'Incorrect username or password'],200);
        }
    }
}