<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agents;


class DashboardController extends Controller
{
    function index(){
      return view('mains.dashboard');
    }
}
