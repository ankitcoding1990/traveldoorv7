<?php

namespace App\Http\Controllers\Masters;

use App\Models\TourType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\DataTables\TourTypeDatatables;
use App\Services\TourTypeService;
use App\Traits\MyModel;

class TourTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use MyModel;
    public $routeName;
    public function __construct(TourTypeService $service)
    {
        $this->service = $service;
        $this->routeName  = 'tour_type.index';
    }
    public function index(TourTypeDatatables $datatable)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)){
            return $datatable->with(['routeName' => $routeName])->render('mains.masters.tour_type.index',compact('routeName'));
        }else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName])->render('mains.masters.tour_type.index',compact('routeName'));
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
            'tour_type_name' => 'required',
                Rule::unique('tour_type')->where(function($query)use($request){
                    return $query->where('tour_type_name', $request->tour_type_name);
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
        $tourType = TourType::where('id',$id)->firstOrFail();
        return view('mains.masters.tour_type.index',compact('tourType','routeName'));
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
            'tour_type_name' => 'required',
                Rule::unique('tour_type')->where(function($query)use($request,$id){
                    return $query->where('tour_type_name', $request->tour_type_name)->where('id','!=',$id);
                }),
        ]);
        $message = $this->service->store($request);
        session()->flash('status',$message);
        return redirect()->route('tour_type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            return TourType::softDeletes($request->id,$request->status);
        } catch (\Throwable $th) {
           return $th;
        } 
    }

}
