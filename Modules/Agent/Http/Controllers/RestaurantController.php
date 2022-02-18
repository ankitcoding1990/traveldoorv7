<?php

namespace Modules\Agent\Http\Controllers;

use App\Models\Restaurants;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\RestaurantBookingService;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function __construct(RestaurantBookingService $service)
    {
        $this->service=$service;
    }
    public function index()
    {
        $agent = auth()->guard('agent')->user();
        return view('agent::restaurant.search')->with([
          'agent' => $agent,
          'services'  =>  $agent->services
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('agent::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $agent = auth()->guard('agent')->user();
        $restaurant=Restaurants::find($id);
        return view('agent::restaurant.detail')->with([
          'agent' => $agent,
          'services'  =>  $agent->services,
          'restaurant'=>    $restaurant
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('agent::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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

    public function search(Request $request)
    {
        $request->validate([
            'country_id'=> 'required',
            'city_id' =>'required',
            'booking_date' => 'required',
            'booking_time' => 'required'
        ]);
        $res=$this->service->search($request);  
        // dd($res);  
        return $res;
    }
}
