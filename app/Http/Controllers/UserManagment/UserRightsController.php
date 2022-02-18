<?php

namespace App\Http\Controllers\UserManagment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Menu;
use App\Services\UserRightsService;
use App\UserRight;

class UserRightsController extends Controller
{

    function __construct(UserRightsService $userRightService)
    {
        $this->userRightService = $userRightService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::adminUsers()->activeUsers()->get();
      return view('mains.user-management.rights.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $res = $this->userRightService->updateOrCreate($request);
        $res['table'] = 'rights';
        return response($res, 200);
    }
    function getUsersRights(Request $request){
        if($request->has('user_id')){
            $user = User::find($request->user_id);
            $menus = Menu::whereNull('menu_pid')->get();
            $userRights = $user->rights;
            $html = view('mains.user-management.rights.render-html', compact('user', 'menus', 'userRights'));
            return response(['html' => $html->render(), 'status' => true]);
        }
        return response(['status' => false, 'html' => '<h1>User Not Found!<h1>']);
    }
}
