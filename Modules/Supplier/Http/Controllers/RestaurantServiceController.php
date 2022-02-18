<?php

namespace Modules\Supplier\Http\Controllers;

use App\DataTables\RestaurantsDataTable;
use App\Http\Requests\RestaurantManagementRequest;
use App\Models\Restaurants;
use App\Models\ServiceImages;
use App\Services\RestaurantManagementService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RestaurantServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __construct(RestaurantManagementService $restaurantManagementService){
        $this->restaurantManagementService = $restaurantManagementService;
        $this->routeName='restaurant.index';
    }
    public function index(RestaurantsDataTable $datatable)
    {
        $routeName=$this->routeName;
        $isSupplier=true;
        return $datatable->with(['user_id' => auth()->guard('supplier')->user()->id, 'isSupplier' => true , 'routeName' => $routeName, 'filter' => 'undrafted'])->render('supplier::pages.service-managements.restaurant.index', compact('routeName', 'isSupplier')); 
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('supplier::pages.service-managements.restaurant.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(RestaurantManagementRequest $request)
    {
        return $this->restaurantManagementService->store($request);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $routeName=$this->routeName;
        $model = Restaurants::where('id',$id)->FirstorFail();
        $images=ServiceImages::where('restaurant_id',$id)->get();
        $isSupplier=true;
        return view('mains.restaurants.restaurant_management.view',compact('model','images','isSupplier'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $restaurant = Restaurants::where('id',$id)->FirstorFail();
        return view('supplier::pages.service-managements.restaurant.create',compact('restaurant'));
        // return view('supplier::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(RestaurantManagementRequest $request, $id)
    {
        return $this->restaurantManagementService->store($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function index_drafted(RestaurantsDataTable $datatable)
    {
        $routeName=$this->routeName;
        $isSupplier=true;
        return $datatable->with(['user_id' => auth()->guard('supplier')->user()->id, 'isSupplier' => true , 'routeName' => $routeName, 'filter' => 'drafted'])->render('supplier::pages.service-managements.restaurant.index', compact('routeName', 'isSupplier')); 
    }

    public function create_image($id)
    {
        $restaurant=Restaurants::find($id);
        return view('supplier::pages.service-managements.restaurant.upload_images',compact('restaurant'));
    }

    public function edit_image($id)
    {
        $restaurant = Restaurants::where('id',$id)->FirstorFail();
        return view('supplier::pages.service-managements.restaurant.upload_images',compact('restaurant','id'));
    }
    public function store_image($id)
    {
        return $this->restaurantManagementService->updateDrafted($id);
    }

}
