<?php

namespace App\Http\Controllers\ServiceManagement;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ActivityPricing;
use App\Services\ActivityPricingService;
use function GuzzleHttp\json_decode;

class ActivityPricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ActivityPricingService $service)
    {
        $this->routeName = 'activity.prices';
        $this->service = $service;
    }
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $routeName = $this->routeName;
        $id = decrypt($id);
        $age_group = Activity::where('id',$id)->first()->age_groups;
        return view('service-management.activities.create',compact('id','age_group', 'routeName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = $this->service->store($request);
        return $message;
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
    public function edit($activity_id, $price_ids)
    {
        $routeName = $this->routeName;
        $id = decrypt($activity_id);
        $price_ids = decrypt($price_ids);
        $pricing_ids = json_decode($price_ids);
        $pricings = ActivityPricing::whereIn('id',$pricing_ids)->get();
        $age_group = Activity::where('id',$id)->first()->age_groups;
        return view('service-management.activities.edit',compact('id','age_group','pricings','price_ids', 'routeName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $price_ids)
    {
        $message = $this->service->store($request, json_decode($price_ids));
        return $message;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($activity_id, $pricing_id)
    {
        $message = $this->service->delete($pricing_id);
        return $message;
    }
}
