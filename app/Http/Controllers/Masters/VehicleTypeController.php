<?php

namespace App\Http\Controllers\Masters;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Services\VehicleTypeService;
use App\DataTables\vehicalTypeDatatables;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $service;
    public $routeName;
    public function __construct(VehicleTypeService $service)
    {
        $this->routeName = 'vehicles_types.index';
        $this->service   = $service;

    }
    public function index(vehicalTypeDatatables $datatables)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)) {
            return $datatables->with(['routeName' => $routeName])->render('mains.masters.vehicle_type.index',compact('routeName'));
        } else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatables->with(['user_id' => auth()->user()->id, 'routeName' => $routeName])->render('mains.masters.vehicle_type.index',compact('routeName'));
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
            'vehicle_type_name' => [
                'required',
                    Rule::unique('vehicle_type')->where(function($query)use($request){
                        return $query->where('vehicle_type_name', $request->language_name);
                    }),
                ],
            'vehicle_type_min' => 'required|numeric',
            'vehicle_type_max' => 'gte:vehicle_type_min|required|numeric',

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
        $vehicle = VehicleType::where('id', $id)->firstOrFail();
        return view('mains.masters.vehicle_type.index', compact('vehicle','routeName'));
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
        $request->validate(['vehicle_type_name' => 'required', 'vehicle_type_min' => 'required','vehicle_type_max' => 'required']);
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
       return $this->service->delete($id);
    }

    public function ChangeState(Request $request)
    {
        return $this->service->ChangeState($request);
    }
}
