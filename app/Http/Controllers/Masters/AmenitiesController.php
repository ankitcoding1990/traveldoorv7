<?php

namespace App\Http\Controllers\Masters;

use App\Models\Amenities;
use Illuminate\Http\Request;
use App\Services\AmenitiesService;
use App\Http\Controllers\Controller;
use App\DataTables\AmenitiesDatatables;
use Exception;

class AmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $routeName;

    public function __construct(AmenitiesService $service)
    {
        $this->service = $service;
        $this->routeName = 'amenities.index';
    }
    public function index(AmenitiesDatatables $datatables)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)) {
            return $datatables->with(['routeName' => $routeName])->render('mains.masters.amenities.index',compact('routeName'));
        } else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatables->with(['user_id' => auth()->user()->id, 'routeName' => $routeName])->render('mains.masters.amenities.index',compact('routeName'));
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

    public function switchState(Request $request){
        $message = $this->service->statechanger($request->id, $request->state);
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
        $amenities = Amenities::where('id',$id)->firstOrFail();
        return view('mains.masters.amenities.index',compact('amenities','routeName'));
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
        $request->validate(['amenities_name' => 'required']);
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
}
