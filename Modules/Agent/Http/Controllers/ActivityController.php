<?php

namespace Modules\Agent\Http\Controllers;

use App\Models\Activity;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('agent::index');
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
    public function getActivities(Request $request)
    {
        $activity = Activity::where('country_id',$request->country_id)->where('city_id',$request->city_id)->whereDate('valid_from','>',$request->booking_date);
        if($request->activity_type_id != null){
            $activity->where('activity_type_id', $request->activity_type_id);
        }
        $html = view('agent::html_render.activities_list')->with(['activities' => $activity->get()]);
        return response($html->render());

    }
    public function show($id)
    {
        $agent = auth()->guard('agent')->user();
        $activity = Activity::find($id)->firstOrFail();
        return view('agent::activity.detail')->with([
          'agent' => $agent,
          'activity' => $activity,
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

    public function search()
    {
        $agent = auth()->guard('agent')->user();
        return view('agent::activity.search')->with([
          'agent' => $agent,
          'services'  =>  $agent->services
        ]);
    }

}
