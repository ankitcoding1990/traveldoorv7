<?php

namespace App\Http\Controllers\Masters;

use App\Models\Cities;
use App\Models\States;
use App\Models\Countries;
use App\Models\TransferMaster;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Services\TransferMasterService;
use App\DataTables\TransferMasterDatatable;

class TransferMasterController extends Controller
{
    public $routeName;

    public function __construct(TransferMasterService $service)
    {
        $this->service = $service;
        $this->routeName  = 'transfer_master.index';
    }
    public function index(TransferMasterDatatable $datatable)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)){
            return $datatable->with(['routeName' => $routeName])->render('mains.masters.transfer_master.index',compact('routeName'));
        }else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName])->render('mains.masters.transfer_master.index',compact('routeName'));
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

    public function getCities(Request $request)
    {
        $country = $request->country;
        $cities = array();
        $states = States::where('country_id',$country)->get();
        foreach ($states as $index => $state){
            $list[] = Cities::where('state_id',$state->id)->pluck('name','id');
        }
        foreach($list as $key => $value){
            foreach ($value as $k => $v){
                $cities[$k] = $v;
            }
        }
        if(count($cities) > 0){
            return response($cities);
        }else{
            return 0;
        }

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
            'master_type' => 'required',
            'master_name' => 'required',
                Rule::unique('transfer_master')->where(function($query)use($request){
                    return $query->where('master_name', $request->master_name);
                }),
            'master_country' => 'required',
            'master_city' => 'required',
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
        $transferMaster = TransferMaster::where('id',$id)->firstOrFail();
        return view('mains.masters.transfer_master.index',compact('transferMaster','routeName'));
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
            'master_type' => 'required',
            'master_name' => 'required',
                Rule::unique('transfer_master')->where(function($query)use($request,$id){
                    return $query->where('master_name', $request->master_name)->where('master_id', '!=', $id);
                }),
            'master_country' => 'required',
            'master_city' => 'required',
        ]);
        $message = $this->service->store($request, $id);
        return $message;

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

    public function ChangeState(Request $request)
    {
        return $this->service->ChangeState($request->id, $request->state);
    }
}
