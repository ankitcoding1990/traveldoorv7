<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    function logout($gurad_name = null){
      if ($gurad_name != null) {
        if (Auth::guard($gurad_name)->check()) {
          Auth::guard($gurad_name)->logout();
        }
      }else{
        if (Auth::check()) {
          Auth::logout();
        }
      }
      return redirect()->route('login');
    }
}
