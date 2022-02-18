<?php

namespace App\Http\Controllers\Restaurants;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Restaurants;
use App\Models\RestaurantMenuCategory;
use App\Models\RestaurantFood;
use App\Services\RestaurantFoodService;

class Restaurant_FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $restaurantFoodService;
    public function __construct(RestaurantFoodService $restaurantFoodService)
    {
        $this->restaurantFoodService = $restaurantFoodService;
        $this->routeName='restaurant-foods.index';
    }
    public function index()
    {
        $routeName=$this->routeName;
        if (auth()->user()->hasAddPermission($routeName)) {
            $fetch_restaurants = Restaurants::get();
            $menu_categories = RestaurantMenuCategory::get();
            return view('mains.restaurants.restaurant_food.index')->with(compact('fetch_restaurants', 'menu_categories'));
        }
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
        return $res = $this->restaurantFoodService->store($request);

        //
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
        if (session()->has('travel_users_id')) {
            $emp_id = session()->get('travel_users_id');
            $foods = RestaurantFood::where('restaurant_food_id', $id)->FirstorFail();
            if (!empty($foods)) {
                $fetch_restaurants = Restaurants::get();
                $menu_categories = RestaurantMenuCategory::get();
                return view('mains.restaurants.restaurant_food.edit',compact('foods', 'fetch_restaurants', 'menu_categories'));
            }else{
                return redirect()->back();
            }
        } else {
            return redirect()->route('index');
        }
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
        $request->validate(['restaurant_id_fk' => 'required',
                            'menu_category_id_fk' => 'required',
                            'food_price' => 'required',
                            'food_unit'  => 'required',
                            'food_name' =>[
                            'required',
                             Rule::unique('restaurants_food')->where(function($query)use($request,$id){
                             return $query->where('food_name',$request->food_name)->where('restaurant_food_id','!=', $id);
                }),
            ],
        ]);

        $food_role = $request->get('food_role');
        $res = $this->restaurantFoodService->update($request,$id);
        if($res){
            session()->flash('status',$res);
            return redirect()->route('food-management');
        }
        // if($res['status']==true){
        //     session()->flash('status',$res);
        //     return redirect()->route('food-management');
        // }elseif($res['status' == false]){
        //     session()->flash('status',$res);
        // }else{
        //     session()->flash('status',$res);
        // }
        //
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

    public function activeOrInactive(Request $request)
    {
        return $this->restaurantFoodService->activeOrInactive($request);
        // dd("ehere");

    }

    public function food_details($food_id){
        $this->restaurantFoodService->food_details($food_id);
    }
}
