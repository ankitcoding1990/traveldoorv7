<?php

namespace App\Http\Controllers\UserManagment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\MenusDataTable;
use App\Models\Menu;
use App\Http\Requests\MenusRequest;
use App\Services\MenuService;

class MenusController extends Controller
{
    protected $menuService;
    function __construct(MenuService $menuService){
      $this->menuService = $menuService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MenusDataTable $dataTable)
    {
        return $dataTable->render('mains.user-management.menus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mains.user-management.menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenusRequest $request)
    {
        $res = $this->menuService->store($request);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('mains.user-management.menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenusRequest $request, $id)
    {
      $res = $this->menuService->update($request, $id);
      if ($res['status']) {
        $res['redirects'] = route('menus.index');
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
}
