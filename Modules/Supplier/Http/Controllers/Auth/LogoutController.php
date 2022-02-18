<?php

namespace Modules\Supplier\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LogoutController extends Controller
{
  function logout(){
    $gurad_name = 'supplier';
    if ($gurad_name != null) {
      if (Auth::guard($gurad_name)->check()) {
          Auth::guard($gurad_name)->logout();
          return redirect()->route('supplier.login');
      } else {
        return redirect()->route('supplier.login');
      }
    }else{
      if (Auth::check()) {
        Auth::logout();
      }
    }
  }
}
