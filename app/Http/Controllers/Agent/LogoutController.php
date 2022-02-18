<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

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
    }
}
