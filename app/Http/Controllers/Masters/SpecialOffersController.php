<?php

namespace App\Http\Controllers\Masters;

use App\Models\SavedItinerary;
use App\Models\Special_offers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SpecialOffersService;
use App\DataTables\SpecialOffersDatatables;

class SpecialOffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(SpecialOffersService $service)
    {
        $this->service = $service;
        $this->routeName='special_offers.index';
    }
    public function index(SpecialOffersDatatables $datatables)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)){
            return $datatables->with(['routeName' => $routeName])->render('mains.masters.special_offers.index',compact('routeName'));
        }else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatables->with(['user_id' => auth()->user()->id, 'routeName' => $routeName])->render('mains.masters.special_offers.index',compact('routeName'));
        }
        return abort(403, 'You have no permission');$routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)){
            return $datatables->with(['routeName' => $routeName])->render('mains.masters.special_offers.index',compact('routeName'));
        }else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatables->with(['user_id' => auth()->user()->id, 'routeName' => $routeName])->render('mains.masters.special_offers.index',compact('routeName'));
        }
        return abort(403, 'You have no permission');;
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
            'title' => 'required|unique:special_offers,title',
            'description' => 'required',
            'image' => 'image|required',
            'package' => 'required',
            'price' => 'required',
            'itinerary_id' => 'numeric|required',
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
        $specialOffer = Special_offers::where('id',$id)->firstOrFail();
        $specialOffer->inclusions =unserialize($specialOffer->inclusions);
        $specialOffer->exclusions = unserialize($specialOffer->exclusions);
        return view('mains.masters.special_offers.index',compact('specialOffer','routeName'));

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
            'title' => 'required',
            'description' => 'required',
            'package' => 'required',
            'price' => 'required',
            'itinerary_id' => 'required',
        ]);
        $message = $this->service->store($request);
        session()->flash('status', $message);
        return redirect()->route('special_offers.index');
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
