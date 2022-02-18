<?php

namespace App\Http\Controllers\Masters;

use App\Services\HotelMealService;
use App\Models\HotelMeal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\DataTables\HotelMealsDatatables;

class HotelMealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $service;
    public $routeName;
    public function __construct(HotelMealService $service)
    {
        $this->service = $service;
        $this->routeName = 'hotelmeal.index';
    }
    public function index(HotelMealsDatatables $datatable)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)){
            return $datatable->with(['routeName' => $routeName])->render('mains.masters.hotel_meal.index',compact('routeName'));
        }else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName])->render('mains.masters.hotel_meal.index',compact('routeName'));
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
        $request->validate(['hotel_meals_name' => [
            'required',
                Rule::unique('hotel_meals')->where(function($query)use($request){
                    return $query->where('hotel_meals_name', $request->hotel_meals_name);
                }),
            ],
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
        $hotelmeal = HotelMeal::where('id', $id)->firstOrFail();
        return view('mains.masters.hotel_meal.index', compact('hotelmeal','routeName'));
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
        $request->validate(['hotel_meals_name' => [
            'required',
                Rule::unique('hotel_meals')->where(function($query)use($request,$id){
                    return $query->where('hotel_meals_name', $request->hotel_meals_name)->where('id','!=',$id);
                }),
            ],
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
        return $this->service->delete($id);
    }

    public function ChangeState(Request $request)
    {
        return $this->service->ChangeState($request);
    }
}
