<?php

namespace App\Http\Controllers\Masters;

use App\Models\SubAmenities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SubAmenitiesService;
use App\DataTables\SubAmenitiesDatatables;
use App\Repositories\SubAmenitiesRespository;

class SubAmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $routeName;
    public function __construct(SubAmenitiesService $service)
    {
        $this->service = $service;
        $this->routeName = 'sub_amenities.index';
    }
    public function index(SubAmenitiesDatatables $datatable)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)){
            return $datatable->with(['routeName' => $routeName])->render('mains.masters.sub_amenities.index',compact('routeName'));
        }else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName])->render('mains.masters.sub_amenities.index',compact('routeName'));
        }
        return abort(403, 'You have no permission');
        // return $datatables->render(,compact(''));
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
        $message = $this->service->store($request);
        return $message;
    }

    public function switchState(Request $request)
    {
        $message = $this->service->statechanger($request->id, $request->state);
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
        $SubAmenities = SubAmenities::where('id',$id)->firstOrFail();
        return view('mains.masters.sub_amenities.index',compact('SubAmenities','routeName'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['amenities_id' => 'required','sub_amenities_name' => 'required']);
        $message = $this->service->store($request, $id);
        return $message;
    }

    public function destroy($id)
    {
        $message = $this->service->delete($id);
        return $message;
    }
}
