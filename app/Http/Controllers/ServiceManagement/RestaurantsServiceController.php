<?php

namespace App\Http\Controllers\ServiceManagement;

use App\DataTables\RestaurantsDataTable;
use App\Models\Cities;
use App\Models\States;
use App\Models\Currency;
use App\Models\Countries;
use App\Models\Supplier;
use App\Models\Restaurants;
use App\Models\RestaurantType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RestaurantManagementService;
use App\Http\Requests\RestaurantManagementRequest;
use App\Models\ServiceImages;

class RestaurantsServiceController extends Controller
{

    protected $restaurantManagementService;
    public function __construct(RestaurantManagementService $restaurantManagementService){
        $this->restaurantManagementService = $restaurantManagementService;
        $this->routeName='restaurants.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RestaurantsDataTable $datatable)
    {   
        $routeName=$this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)) {
            return $datatable->with(['filter'=>'undrafted'])->render('mains.restaurants.restaurant_management.index', compact('routeName'));
        } else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName, 'filter' => 'undrafted'])->render('mains.restaurants.restaurant_management.index', compact('routeName'));
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
        $routeName=$this->routeName;
        if (auth()->user()->hasAddPermission($routeName)){
            return view('mains.restaurants.restaurant_management.create');
        }
        return abort(403, 'You have no permission');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RestaurantManagementRequest $request)
    {
        return $this->restaurantManagementService->store($request);
        // return "reached controller";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $routeName=$this->routeName;
        if (auth()->user()->hasViewPermission($routeName)){
            $model = Restaurants::where('id',$id)->FirstorFail();
            $images=ServiceImages::where('restaurant_id',$id)->get();
            return view('mains.restaurants.restaurant_management.view',compact('model','images'));
        }
        return abort(403, 'You have no permission');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $restaurant = Restaurants::where('id',$id)->FirstorFail();
        return view('mains.restaurants.restaurant_management.create',compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RestaurantManagementRequest $request, $id)
    {
        return $this->restaurantManagementService->store($request,$id);
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

    public function changeStatus(Request $request)
    {
        return $this->restaurantManagementService->changeStatus($request->restaurant_id, $request->column, $request->state == 'active'? 1 : 0 );
        
    }

    public function index_drafted(RestaurantsDataTable $datatable)
    {
        $routeName=$this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)) {
            return $datatable->with(['filter'=>'drafted'])->render('mains.restaurants.restaurant_management.index', compact('routeName'));
        } else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName, 'filter' => 'drafted'])->render('mains.restaurants.restaurant_management.index', compact('routeName'));
        }
        return abort(403, 'You have no permission');
    }

    public function create_image($id)
    {
        $restaurant=Restaurants::find($id);
        return view('mains.restaurants.restaurant_management.upload_images',compact('restaurant'));
    }

    public function edit_image($id)
    {
        $restaurant = Restaurants::where('id',$id)->FirstorFail();
        return view('mains.restaurants.restaurant_management.upload_images',compact('restaurant','id'));
    }
    public function store_image($id)
    {
        return $this->restaurantManagementService->updateDrafted($id);
    }

    
    public function activeOrInactive(Request $request){
        return $this->restaurantManagementService->activeOrInactive($request);
    }
}
