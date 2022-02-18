<?php

namespace App\Http\Controllers\UserManagment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Http\Requests\UsersRequest;
use App\Services\UserService;
use App\User;

class UsersController extends Controller
{
    protected $userService;
    function __construct(UserService $userService){
      $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('mains.user-management.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mains.user-management.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
      $res = $this->userService->store($request);
      if ($res['status']) {
        return response($res, 200);
      }
      return response($res, 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = User::findOrFail($id);
      return view('mains.user-management.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('mains.user-management.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, $id)
    {
        $res = $this->userService->update($request, $id);
        if ($res['status']) {
          $res['redirect'] = route('users.index');
          return response($res, 200);
        }
        return response($res, 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ChangeState(Request $request)
    {
      try{
          if($request->state=='inactive'){
            User::find($request->id)->update(['users_status'=>0]);
          }
          else if($request->state=='active'){
            User::find($request->id)->update(['users_status'=>1]);
          }
          return ['title' => 'success', 'subject' => 'User '.$request->state.'d','type' => 'success'];

      } catch(\Throwable $th) {
          return ['title' => 'success', 'subject' => 'Failed! Due to '.$th->getMessage(), 'type' => 'error'];
      }
      
    }
}
