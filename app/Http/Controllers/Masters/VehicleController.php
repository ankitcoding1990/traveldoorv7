<?php

namespace App\Http\Controllers\Masters;

use App\Models\Vehicles;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\VehicleService;
use App\Http\Controllers\Controller;
use App\DataTables\VehicleDatatables;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $routeName;
    public function __construct(VehicleService $service)
    {
        $this->service = $service;
        $this->routeName  = 'vehicle.index';
    }
    public function index(VehicleDatatables $datatable)
    {
        $routeName = $this->routeName;

        if(auth()->user()->hasAddPermission($this->routeName,1)){
            $vehicle_type = VehicleType::all()->pluck('vehicle_type_name','id');
        } else {
            $vehicle_type = VehicleType::where('vehicle_type_created_by',auth()->user()->id)->pluck('vehicle_type_name','id');
        }

        if(auth()->user()->hasViewPermission($this->routeName,1)){
            return $datatable->with(['routeName' => $routeName])->render('mains.masters.vehicle.index',compact('routeName','vehicle_type'));
        }else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName])->render('mains.masters.vehicle.index',compact('routeName','vehicle_type'));
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

    public function switchState(Request $request)
    {
        $message = $this->service->statechanger($request->id);
        return $message;
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
            'vehicle_name' => 'required',
                Rule::unique('vehicle')->where(function($query)use($request){
                    return $query->where('vehicle_name', $request->vehicle_name);
                }),
            'vehicle_type_id' => 'required'
        ]);
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
    public function edit($id)
    {
        $routeName = $this->routeName;

        if(auth()->user()->hasAddPermission($this->routeName,1)){
            $vehicle_type = VehicleType::all()->pluck('vehicle_type_name','id');
        } else {
            $vehicle_type = VehicleType::where('vehicle_type_created_by',auth()->user()->id)->pluck('vehicle_type_name','id');
        }

        $vehicle = Vehicles::where('id',$id)->firstOrFail();
        return view('mains.masters.vehicle.index',compact('vehicle','vehicle_type','routeName'));
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
            'vehicle_name' => 'required',
                Rule::unique('vehicle')->where(function($query)use($request,$id){
                    return $query->where('vehicle_name', $request->vehicle_name)->where('id','!=',$id);
                }),
            'id' => 'required'
        ]);
        $message = $this->service->store($request);
        session()->flash('status',$message);
        return redirect()->route('vehicle.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = $this->service->delete($id);
        return $message;
    }
}
