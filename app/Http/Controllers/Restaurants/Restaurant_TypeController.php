<?php

namespace App\Http\Controllers\Restaurants;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\RestaurantTypesDataTable;
use App\Models\RestaurantType;
use App\Services\RestaurantTypeService;

class Restaurant_TypeController extends Controller
{
    protected $RestaurantTypeService;
    function __construct(RestaurantTypeService $RestaurantTypeService){
        $this->RestaurantTypeService = $RestaurantTypeService;
        $this->routeName='restaurant-types.index';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RestaurantTypesDataTable $dataTable)
    {
        $routeName=$this->routeName;
        if(auth()->user()->hasViewPermission($routeName,1)){
            return $dataTable->render('mains.restaurants.restaurant_type.index',compact('routeName'));
        }else if(auth()->user()->hasViewPermission($routeName)){
            return $dataTable->with(['user_id'=>auth()->user()->id, 'routeName'=>$routeName])->render('mains.restaurants.restaurant_type.index',compact('routeName'));
        }
        return abort(403, 'You have no permission');
        
        //
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
        $request->validate([
            'restaurant_type_name' => 'required|unique:restaurant_types,restaurant_type_name'
        ]);
        $res = $this->RestaurantTypeService->store($request);
        if($res['status']==true){
            session()->flash('status',$res);
            return redirect()->route('restaurant-types.index');
        }else if($res['status' == false]){
            session()->flash('status',$res);
        }else{
            session()->flash('status',$res);
        }
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
        $restaurant_type = RestaurantType::find($id);
        return view('mains.restaurants.restaurant_type.edit',compact('restaurant_type', 'routeName'));

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
            'restaurant_type_name' => 'required|unique:restaurant_types,restaurant_type_name'
        ]);
        $res = $this->RestaurantTypeService->update($request);
        // return $res;
        if($res['status']==true){
            session()->flash('status',$res);
            return redirect()->route('restaurant-types.index');
        }elseif($res['status' == false]){
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
