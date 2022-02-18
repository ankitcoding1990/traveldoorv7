<?php

namespace App\Http\Controllers\Masters;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminTermsCancellationMaster;
use App\Services\ServiceTermsService;
use App\Models\OurService;

class ServiceTermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $routeName;
    public function __construct(ServiceTermsService $service)
    {
        $this->service = $service;
        $this->routeName  = 'service_terms.index';
    }

    public function index()
    {
        $service   = OurService::where('status','1')->pluck('name','id');
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)){
            return view('mains.masters.service_terms.index',compact('routeName','service'));
        } else if(auth()->user()->hasViewPermission($this->routeName)){ 
            return view('mains.masters.service_terms.index',compact('routeName','service'));
        }
        return abort(403, 'You have no permission');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getTerms(Request $request)
    {
        $terms = AdminTermsCancellationMaster::where('service_id',$request->service)->orderBy('id','desc')->first();
        if($terms)
            return $terms;
        else
            return 0;
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
