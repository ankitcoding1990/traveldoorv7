<?php

namespace Modules\Supplier\Http\Controllers;

use App\Models\Sightseeing;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use App\Services\SightseeingManagementServices;
use App\DataTables\SightseeingsServicesDatatables;

class SightSeeingServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function __construct(SightseeingManagementServices $SightseeingManagmentServices)
    {
        $this->routeName = 'sightseeing.index';
        $this->SightseeingManagmentServices = $SightseeingManagmentServices;
    }
    public function validateBasicRequest($request){
        return $request->validate([
             'tour_name' => 'required',
             'tour_type' => 'required',
             'country_id' => 'required',
             'city_covered' => 'required',
             'from_city_id' => 'required',
             'city_between_ids.*' => 'required_if:city_covered,>,2',
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
             'default_driver_price' => 'required',
         ]);
     }
     public function validatePricingRequest($request){
         return $request->validate([
             'group_adult_cost' => 'required',
             'group_child_cost' => 'required',
             'group_max_pax' => 'required',
            //  'group_tour_terms' => 'required',
         ]);
     }
     public function validateDescriptionRequest($request){
         return $request->validate([
            //  'tour_desc' => 'required',
            //  'attractions' => 'required',
         ]);
     }
    public function index(SightseeingsServicesDatatables $datatable)
    {
        $routeName = $this->routeName;
        $countDraft = Sightseeing::where('draft_status', 1)->where('created_supplier_id',auth()->guard('supplier')->user()->id )->count();
        return $datatable->with(['user_id' => auth()->guard('supplier')->user()->id, 'routeName' => $routeName, 'filter' => 'undrafted','isSupplier' => true])->render('supplier::pages.service-managements.sightseeings.index',compact('routeName', 'countDraft'));
    }
    public function drafted(SightseeingsServicesDatatables $datatable)
    {
        $routeName = $this->routeName;
        return $datatable->with(['user_id' => auth()->guard('supplier')->user()->id, 'routeName' => $routeName, 'filter' => 'drafted','isSupplier' => true])->render('supplier::pages.service-managements.sightseeings.index', compact('routeName'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $routeName = $this->routeName;
        return view('supplier::pages.service-managements.sightseeings.create', compact('routeName'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
       $this->validateBasicRequest($request);
       $message =  $this->SightseeingManagmentServices->store($request);
        $message['redirect'] = route('sightseeing.prices.create',[$message['id']]);
        return $message;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $id = decrypt($id);
        $model = Sightseeing::where('id',$id)->first();
        return view('supplier::pages.service-managements.sightseeings.view',compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $routeName = $this->routeName;
        $id = decrypt($id);
        $sightseeing = Sightseeing::where('id',$id)->firstOrFail();
        return view('supplier::pages.service-managements.sightseeings.edit',compact('routeName','sightseeing'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //dd($id);
        $this->validateBasicRequest($request);
        $message =  $this->SightseeingManagmentServices->update($request, $id);
        $message['redirect'] = route('sightseeing.prices.create',[$message['id']]);
        return $message;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
       return $this->SightseeingManagmentServices->delete($id);
    }
    public function pricesCreate($id){    
        $routeName = $this->routeName;
        $id = decrypt($id);
        $sightseeing = Sightseeing::where('id',$id)->firstOrFail();
        return view('supplier::pages.service-managements.sightseeings.create', compact('id', 'routeName','sightseeing'));
    }
    public function pricesStore(request $request, $id){
        
        $this->validatePricingRequest($request);
        $message =  $this->SightseeingManagmentServices->storePricing($request, $id);
        $message['redirect'] = route('sightseeing.images.upload',[$message['id']]);
        return $message;
    }
    public function imagesUploadIndex($id)
    {
        //dd($id);
        $id = decrypt($id);
        $routeName = $this->routeName;
        return view('supplier::pages.service-managements.sightseeings.create',compact('routeName','id'));
    }
    public function imagesStore($id){
        $id = encrypt($id);
        return ['title' => 'success','message' => 'Next add sightseeing descriptions', 'redirect' => route('sightseeing.description.create',['id' => $id])];
    }
    public function descriptionCreate($id){
       
        $routeName = $this->routeName;
        $id = decrypt($id);
        //dd($id);
        $sightseeing = Sightseeing::where('id',$id)->firstOrFail();
        return view('supplier::pages.service-managements.sightseeings.create', compact('id', 'routeName','sightseeing'));
    }
    public function descriptionStore(Request $request, $id){
      
        $this->validateDescriptionRequest($request);
        $message = $this->SightseeingManagmentServices->storeDescription($request, $id);
        $message['redirect'] = route('sightseeing.index');
        return $message;
    }
}
