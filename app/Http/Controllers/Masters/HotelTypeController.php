<?php

namespace App\Http\Controllers\Masters;

use App\Models\HotelType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\HotelTypeService;
use App\Http\Controllers\Controller;
use App\DataTables\HotelTypeDatatables;

class HotelTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $routeName;
    public function __construct(HotelTypeService $service)
    {
        $this->service   = $service;
        $this->routeName = 'hotel_type.index';
    }
    public function index(HotelTypeDatatables $datatable)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)){
            return $datatable->with(['routeName' => $routeName])->render('mains.masters.hotel_type.index',compact('routeName'));
        }else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName])->render('mains.masters.hotel_type.index',compact('routeName'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'hotel_type_name' => 'required',
                Rule::unique('hotel_type')->where(function($query)use($request){
                    return $query->where('hotel_type_name', $request->hotel_type_name);
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
        $hotelType = HotelType::where('id',$id)->firstOrFail();
        return view('mains.masters.hotel_type.index',compact('hotelType','routeName'));
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
            'hotel_type_name' => 'required',
                Rule::unique('hotel_type')->where(function($query)use($request,$id){
                    return $query->where('hotel_type_name', $request->hotel_type_name)->where('id','!=',$id);
                }),
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
}
