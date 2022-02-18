<?php

namespace App\Http\Controllers\Masters;

use App\Models\Services;
use App\Models\Countries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ServiceMasterService;
use App\DataTables\ServiceMasterDatatables;

class ServiceMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $routeName;
    public function __construct(ServiceMasterService $service)
    {
        $this->routeName  = 'service_master.index';
        $this->service = $service;
    }
    public function index(ServiceMasterDatatables $datatable)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)){
            return $datatable->with(['routeName' => $routeName])->render('mains.masters.service_master.index',compact('routeName'));
        } else if(auth()->user()->hasViewPermission($this->routeName)){ 
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName])->render('mains.masters.service_master.index',compact('routeName'));
        }
        return abort(403, 'You have no permission');
        // return $datatables->render('mains.masters.service_master.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mains.masters.service_master.create');

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
            'service_name' => 'required|unique:service,service_name',
            'country_id' => 'required',
            'city_id' => 'required',
            'service_type' => 'required',
            'price_per_pax' => 'numeric|required',
            'price_per_service' => 'numeric|required',
            'service_description' => 'required',
            'service_image' => 'required'
        ]);
        $message = $this->service->store($request);
        session()->flash('status',$message);
        return redirect()->route('service_master.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Services::where('id',$id)->firstOrFail();
        $country = Countries::where('id',$service->country_id)->firstOrFail();
        $service->country = $country->country_name;
        return view('mains.masters.service_master.details',compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Services::where('id',$id)->firstOrFail();
        return view('mains.masters.service_master.create',compact('service'));
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
            'service_name' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'service_type' => 'required',
            'price_per_pax' => 'numeric|required',
            'price_per_service' => 'numeric|required',
            'service_description' => 'required',
            'service_image' => 'image'
        ]);

        $message = $this->service->store($request);
        session()->flash('status',$message);
        return redirect()->route('service_master.index');
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
