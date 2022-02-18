<?php

namespace Modules\Agent\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LogoutController extends Controller
{
  function logout(){
    $gurad_name = 'agent';
    if ($gurad_name != null) {
      if (Auth::guard($gurad_name)->check()) {
          Auth::guard($gurad_name)->logout();
          return redirect()->route('agent.login');
      } else {
        return redirect()->route('agent.login');
      }
    }else{
      if (Auth::check()) {
        Auth::logout();
      }
    }
  }
}

