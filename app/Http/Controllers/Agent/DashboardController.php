<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['agent']);
        // $this->middleware('AgentMiddleware');
    }
    public function dashboard()
    {
        return view('agent.home');
    }
}
