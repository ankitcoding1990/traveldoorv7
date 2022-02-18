<?php

namespace App\Http\Controllers\Restaurants;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\RestaurantMenuCategoryDataTable;
use App\Models\RestaurantMenuCategory;
use App\Services\RestaurantMenuService;

class Restaurant_Menu_CategoryController extends Controller
{
    protected $restaurantMenuService;
    function __construct(RestaurantMenuService $restaurantMenuService){
        $this->restaurantMenuService = $restaurantMenuService;
        $this->routeName='restaurant-categories.index';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(RestaurantMenuCategoryDataTable $dataTable)
    {
        $routeName=$this->routeName;
        if(auth()->user()->hasViewPermission($routeName)){
            return $dataTable->with(['routeName'=>$routeName])->render('mains.restaurants.restaurant_menu.index',compact('routeName'));
        }else if(auth()->user()->hasViewPermission($routeName)){
            return $dataTable->with(['user_id'=>auth()->user()->id, 'routeName'=>$routeName])->render('mains.restaurants.restaurant_menu.index',compact('routeName'));
        }
        return abort(403, 'You have no permission');
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
        return $this->restaurantMenuService->store($request);
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
        $routeName=$this->routeName;
        $restaurant_menu = RestaurantMenuCategory::where('id',$id)->FirstorFail();
        return view('mains.restaurants.restaurant_menu.edit', compact('restaurant_menu','routeName'));

        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            // 'name' => 'required|unique:restaurant_menu_categories,name'
            'name' => 'required'
        ]);
        $res = $this->restaurantMenuService->update($request, $id);
        if($res['status'] == true){
            session()->flash('status',$res);
            return redirect()->route('restaurant-categories.index');
        }else if($res['status' == false]){
            session()->flash('status',$res);
        }else{
            session()->flash('status',$res);
        }
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
