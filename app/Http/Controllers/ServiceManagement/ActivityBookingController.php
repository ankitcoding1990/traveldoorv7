<?php

namespace App\Http\Controllers\ServiceManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityBooking;
use App\Services\ActivityBookingService;

class ActivityBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ActivityBookingService $service)
    {
        $this->routeName = 'activity.booking';
        $this->service = $service;
    }
    public function index()
    {
        return view('service-management.activities.create');
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
        $fromDate = Activity::where('id',$id)->first()->valid_from;
        $toDate = Activity::where('id',$id)->first()->valid_to;
        return view('service-management.activities.create',compact('id','routeName','fromDate','toDate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->store($request);
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
    public function edit($id, $booking_ids)
    {
        $routeName = $this->routeName;
        $id = decrypt($id);
        $booking_ids = decrypt($booking_ids);
        $bookings = ActivityBooking::whereIn('id',json_decode($booking_ids, true))->get();
        $fromDate = Activity::where('id',$id)->first()->valid_from;
        $toDate = Activity::where('id',$id)->first()->valid_to;
        return view('service-management.activities.edit',compact('id','bookings','routeName','booking_ids','fromDate','toDate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $booking_ids)
    {
        return $this->service->store($request, $booking_ids);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($activity_id, $booking_id)
    {
        return $this->service->delete($booking_id);
    }
}
