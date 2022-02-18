<?php

namespace App\Http\Controllers\Masters;

use App\Models\Cities;
use App\Models\Countries;
use App\Models\Supplier;
use App\Models\Sightseeing;
use App\Models\VehicleType;
use App\Models\AirportMaster;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Services\SuggestedGuideCostService;

class SuggestedGuideCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct(SuggestedGuideCostService $SuggestedGuideCostService)
     {
        $this->SuggestedGuideCostService = $SuggestedGuideCostService;
        $this->routeName  = 'suggested_cost_guide.index';

     }
    public function index()
    {
        $routeName=$this->routeName;
        $countries = Countries::where('status', 1)->get();
        $suppliers = Supplier::where('status', 1)->get();
        return view('mains.masters.suggested_guide_cost.index',compact('countries','suppliers','routeName'));
    }

    public static function searchSightseeingTour(Request $request) {

    }

    public function searchAirportSightseeingCost(Request $request)
    {
        $city_id = $request->get('city_id');
        $country_id = $request->get('country_id');

        $currency = $request->get('currency') ?? 'GEL';
        $con = 1;
        // if (!empty($currency)) {
        //   $val = ApiController::CurrenctConversion($currency);
        //   $con = $val['currency'][$currency];
        // } else {
          $con = 1;
        // }

        $src                = $request->get('src');
        $fetch_vehicle_type = VehicleType::where('vehicle_type_status', 1)->get();
        $fetch_airports     = AirportMaster::where('airport_master_status', 1)->where('airport_master_country', $country_id)->get();

        $cities = Cities::where('id', $city_id)->first();
        if ($cities->name == "Tbilisi") {
        $fetch_sightseeing = Sightseeing::where('sightseeing_country', $country_id)->where('sightseeing_status', 1)->get();
        } else if ($cities->name == "Kutaisi" || $cities->name == "Batumi") {
        $fetch_sightseeing = Sightseeing::where('sightseeing_country', $country_id)->where(function ($query) use ($city_id) {
            $query->where('sightseeing_city_from', $city_id)->OrWhere('sightseeing_city_to', $city_id);
        })->where('sightseeing_status', 1)->get();
        } else {
        $fetch_sightseeing = Sightseeing::where('sightseeing_country', $country_id)->where(function ($query) use ($city_id) {
            $query->where('sightseeing_city_from', $city_id)->where('sightseeing_city_to', $city_id);
        })->where('sightseeing_status', 1)->get();
        }

        $airport_html     = view('mains.masters.suggested_guide_cost._form_airport_transfer',compact('src','fetch_airports','fetch_vehicle_type','con','currency'))->render();
        $sightseeing_html = view('mains.masters.suggested_guide_cost._form_sightseeing_tour',compact('src','fetch_sightseeing','fetch_vehicle_type','con','currency'))->render();
        return response(['airport_html' => $airport_html, 'sightseeing_html' => $sightseeing_html],200);
    }

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
        $message = $this->SuggestedGuideCostService->store($request);
        return response(['message' => $message[0],'type' => $message[1],'status' => $message[1]],200);
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
        //
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
}
