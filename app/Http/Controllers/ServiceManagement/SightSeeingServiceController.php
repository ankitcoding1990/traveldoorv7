<?php

namespace App\Http\Controllers\ServiceManagement;

use App\DataTables\sightseeingsServicesDatatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sightseeing;
use App\Services\SightseeingManagementServices;

class SightSeeingServiceController extends Controller
{
    public function __construct(SightseeingManagementServices $SightseeingManagmentServices)
    {
        $this->routeName = 'sightseeings.index';
        $this->SightseeingManagmentServices = $SightseeingManagmentServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateBasicRequest($request){
       return $request->validate([
            'tour_name' => 'required',
            'tour_type' => 'required',
            'country_id' => 'required',
            'city_covered' => 'required',
            'from_city_id' => 'required',
            'city_between_ids.*' => 'required_if:city_covered,>,=, 2',
            'to_city_id' => 'required',
            'distance_covered' => 'required',
            'duration' => 'required',
            'fuel_type_id' => 'required',
            'food_cost' => 'required',
            'hotel_cost' => 'required',
            'adult_cost' => 'required',
            'child_cost' => 'required',
            'default_guide_price' => 'required',
            'additional_cost' => 'required',
            'discount' => 'required',
            'default_driver_price' => 'required'
        ]);
    }
    public function validatePricingRequest($request){
        return $request->validate([
            'group_adult_cost' => 'required',
            'group_child_cost' => 'required',
            'group_max_pax' => 'required',
            // 'group_tour_terms' => 'required',
        ]);
    }
    public function validateDescriptionRequest($request){
        return $request->validate([
            // 'tour_desc' => 'required',
            // 'attractions' => 'required',
        ]);
    }
    public function index(sightseeingsServicesDatatables $datatable)
    {
        $routeName = $this->routeName;
        $countDraft = Sightseeing::where('draft_status', 1)->count();
        if(auth()->user()->hasViewPermission($this->routeName,1)) {
            return $datatable->with(['routeName' => $routeName, 'filter' => 'undrafted'])->render('service-management.sightseeings.index',compact('routeName','countDraft'));
        } else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName, 'filter' => 'undrafted'])->render('service-management.sightseeings.index',compact('routeName','countDraft'));
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
        $routeName = $this->routeName;
        return view('service-management.sightseeings.create', compact('routeName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateBasicRequest($request);
       return $this->SightseeingManagmentServices->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = decrypt($id);
        $model = Sightseeing::where('id',$id)->first();
        return view('service-management.sightseeings.view',compact('model'));
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
        $id = decrypt($id);
        $sightseeing = Sightseeing::where('id',$id)->firstOrFail();
        return view('service-management.sightseeings.edit',compact('routeName','sightseeing'));
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
        //dd($id);
        $this->validateBasicRequest($request);
        return $this->SightseeingManagmentServices->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->SightseeingManagmentServices->delete($id);
    }
    public function pricesCreate($id){
        $routeName = $this->routeName;
        $id = decrypt($id);
        $sightseeing = Sightseeing::where('id',$id)->firstOrFail();
        return view('service-management.sightseeings.create', compact('id', 'routeName','sightseeing'));
    }
    public function pricesStore(request $request, $id){
        $this->validatePricingRequest($request);
        return $this->SightseeingManagmentServices->storePricing($request, $id);

    }
    public function imagesUploadIndex($id)
    {
        //dd($id);
        $id = decrypt($id);
        $routeName = $this->routeName;
        return view('service-management.sightseeings.create',compact('routeName','id'));
    }
    public function imagesStore($id){
        $id = encrypt($id);
        return ['title' => 'success','message' => 'Next add sightseeing descriptions', 'redirect' => route('sightseeings.description.create',['id' => $id])];
    }
    public function descriptionCreate($id){
         //dd($id);
        $routeName = $this->routeName;
        $id = decrypt($id);
        $sightseeing = Sightseeing::where('id',$id)->firstOrFail();
        return view('service-management.sightseeings.create', compact('id', 'routeName','sightseeing'));
    }
    public function descriptionStore(Request $request, $id){
        $this->validateDescriptionRequest($request);
        return $this->SightseeingManagmentServices->storeDescription($request, $id);
    }
    public function drafted(SightseeingsServicesDatatables $datatable)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)) {
            return $datatable->with(['routeName' => $routeName, 'filter' => 'drafted'])->render('service-management.sightseeings.index',compact('routeName'));
        } else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName, 'filter' => 'drafted'])->render('service-management.sightseeings.index',compact('routeName'));
        }
        return abort(403, 'You have no permission');
    }

    public function publish(Request $request){
        $id = $request->reference;
        return $this->SightseeingManagmentServices->publish($request, $id);
    }
    public function changeStatus(Request $request)
    {
        if($request->state){
        return $this->SightseeingManagmentServices->changeState($request->sightseeing_id, $request->column, $request->state == 'active'? 1 : 0 );
        }else if($request->approval){
            $approve = 0;
            if($request->approval == 'approved'){
                $approve = 1;
            }else if($request->approval == 'block'){
                $approve = 2;
            }
            return $this->SightseeingManagmentServices->changeState($request->sightseeing_id, $request->column, $approve  );
        }
    }

}
