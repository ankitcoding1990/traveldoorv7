<?php

namespace App\Http\Controllers\Masters;

use App\Models\Cities;
use App\Models\SightSeeing;
use App\Models\VehicleType;
use App\Models\TransferMaster;
use Illuminate\Http\Request;
use App\Models\SuggestedTransferPrice;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Services\VehicleSuggestedCostService;

class VehicleSuggestedCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $routeName;

    public function __construct(VehicleSuggestedCostService $service)
    {
        $this->service = $service;
        $this->routeName  = 'vehicle_suggested_cost.index';
    }

    public function index()
    {
        $routeName = $this->routeName;

        if(auth()->user()->hasViewPermission($this->routeName,1)){
            return view('mains.masters.vehicle_suggested_cost.index',compact('routeName'));
        }else if(auth()->user()->hasViewPermission($this->routeName)){
            return view('mains.masters.vehicle_suggested_cost.index',compact('routeName'));
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

    public function Transfers(Request $request)
    {
        $transfer_type = $request->get('transfer_type');
        $country_id = $request->get('country_id');
        $data = $this->service->getTransferMasterByPluck($transfer_type,$country_id);
        return response($data);
    }

    public function TransferPrices(Request $request)
    {
        $transfer_type = $request->get('transfer_type');
        $country_id = $request->get('country_id');
        $transfer_from = $request->get('transfer_from');
        $currency = $request->get('currency');
        $con = 1;
        if (!empty($currency)) {
            $val = ApiController::CurrenctConversion($currency);
            $con = $val['currency'][$currency];
        } else {
            $con = 1;
            $currency = "GEL";
        }
        $vehicles = VehicleType::where('vehicle_type_status', 1)->get();
        $data = $this->service->getTransferMasterByGet($transfer_type,$country_id);
        $suggestedPrice = SuggestedTransferPrice::where('transfer_type', $transfer_type)->get();
        $html = view('mains.masters.vehicle_suggested_cost.transfer_form',compact('data','vehicles','currency','transfer_type','suggestedPrice','transfer_from'));
        return response($html->render());
    }

    public function SightSeeingPrices(Request $request)
    {
        $city_id = $request->get('city_id');
        $country_id = $request->get('country_id');

        $currency = $request->get('currency');
        $con = 1;
        if (!empty($currency)) {
            $val = ApiController::CurrenctConversion($currency);
            $con = $val['currency'][$currency];
        } else {
            $con = 1;
            $currency = "GEL";
        }

        $src = $request->get('src');
        $vehicles = VehicleType::where('vehicle_type_status', 1)->get();
        $sightSeeing = $this->service->getSightSeeing($city_id,$country_id);
        $html = view('mains.masters.vehicle_suggested_cost.sightseeing_form',compact('city_id','country_id','currency','src','vehicles','sightSeeing','con'));

        return response($html->render());
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
        session()->flash('status',$message);
        return redirect()->back();
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
