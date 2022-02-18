<?php

namespace App\Http\Controllers\Masters;

use App\Models\Cities;
use App\Models\States;
use App\Models\Countries;
use Illuminate\Http\Request;
use App\Services\CitiesService;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Collection;
use App\DataTables\CitiesDatatables;
use App\Http\Controllers\Controller;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $routeName;
    public function __construct(CitiesService $service)
    {
        $this->service   =  $service;
        $this->routeName = 'cities.index';
    }
    public function index(CitiesDatatables $datatable)
    {
        $countries = Countries::where('status',1)->pluck('country_name','id');
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)){
            if(request()->has('country')){
                $id    = request()->get('country');
                $state = request()->get('state');
                return $datatable->with(['id' => $id,'routeName' =>$routeName])->render('mains.masters.city.index',compact('countries','id','routeName','state'));
            }
            return view('mains.masters.city.index',compact('routeName','countries'));
        } else if(auth()->user()->hasViewPermission($this->routeName)) {
            if(request()->has('country')){
                $id    = request()->get('country');
                $state = request()->get('state_id');
                return $datatable->with(['id' => $id,'state' => $state,'routeName' => $routeName])->render('mains.masters.city.index',compact('countries','id','routeName','state'));
            }
            return view('mains.masters.city.index',compact('routeName','countries'));
        }
        return abort(403, 'You have no permission');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getStates(Request $request)
    {
        $country = $request->country;
        $states = States::where('country_id',$country)->pluck('name','id');
        if(count($states) > 0){
            return $states;
        }
        else{
            return 0;
        }
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
        $request->validate([
            'name' => 'required',
                Rule::unique('cities')->where(function($query)use($request){
                    return $query->where('name', $request->city);
                }),
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $request->validate(['name' => 'required',
                Rule::unique('cities')->where(function($query)use($request,$id){
                    return $query->where('name',$request->name)->where('id','!=',$id);
                })
            ]);
        $message = $this->service->store($request);
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
        $message =$this->service->delete($id);
        return $message;
    }
}
