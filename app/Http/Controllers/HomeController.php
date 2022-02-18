<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        return redirect()->route('login');
        // return view('auth.login');
    }
}
