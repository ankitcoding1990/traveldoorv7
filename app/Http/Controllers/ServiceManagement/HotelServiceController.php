<?php
namespace App\Http\Controllers\ServiceManagement;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HotelManagementService;
use App\DataTables\HotelServicesDatatables;


class HotelServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(HotelManagementService $hotelManagementService)
    {
        $this->routeName = "hotels.index";
        $this->hotelManagementService = $hotelManagementService;
    }
    public function index(HotelServicesDatatables $datatables)
    {
        $routeName = $this->routeName;
        $countDraft = Hotel::where('draft_status', 1)->count();
        return $datatables->render('service-management.hotels.index', compact('routeName','countDraft'));
    }
    public function drafted(HotelServicesDatatables $datatable)
    {
        $routeName = $this->routeName;
        if (auth()->user()->hasViewPermission($this->routeName, 1)) {
            return $datatable->with(['routeName' => $routeName, 'filter' => 'drafted'])->render('service-management.hotels.index', compact('routeName'));
        } else if (auth()->user()->hasViewPermission($this->routeName)) {
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName, 'filter' => 'drafted'])->render('service-management.hotels.index', compact('routeName'));
        }
        return abort(403, 'You have no permission');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateBasicRequest($request){
        return $request->validate([
            'hotel_name' => 'required',
            'hotel_type_id' => 'required',
            'supplier_id' => 'required',
            'hotel_contact' => 'required',
            'hotel_rating' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'currency_id' => 'required',
            'location' => 'required',
            'booking_validity_from' => 'required',
            'booking_validity_to' => 'required',
            'hotel_rating' => 'required'
            //'blackout_dates.*' => 'required|array'
        ]);
    }
    public function validateAmenitiesRequest($request){
        return $request->validate([
            'reasons_to_book' => 'required|array',
            'other_policies' => 'required|array',
            'amenities' => 'required|array',
        ]);
    }
    public function validateDescriptionRequest($request){
        return $request->validate([
            'cancel_policy'=>'required',
            'terms_conditions'=>'required',
            'confirm_message'=>'required',
        ]);
    }
    public function create()
    {
        $routeName = $this->routeName;
        return view('service-management.hotels.create',compact('routeName'));
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
        return $this->hotelManagementService->store($request);
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
        $hotel = Hotel::findOrfail($id);
        return view('service-management.hotels.view',compact('hotel'));
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
        $hotel = Hotel::where('id', $id)->firstOrFail();
        return view('service-management.hotels.edit', compact('routeName', 'hotel'));
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
        $this->validateBasicRequest($request);
        return $this->hotelManagementService->store($request, $id);
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
    public function amenitiesCreate($id){

        $routeName = $this->routeName;
        $id = decrypt($id);
        $hotel = Hotel::where('id',$id)->firstOrFail();
        return view('service-management.hotels.create', compact('id', 'routeName','hotel'));
    }
    public function amenitiesStore(Request $request, $id){
        // $this->validateAmenitiesRequest($request);
        return $this->hotelManagementService->amenitiesStore($request,$id);
    }
    public function descriptionCreate($id){

        $routeName = $this->routeName;
        $id = decrypt($id);
        $model = Hotel::where('id',$id)->firstOrFail();
        return view('service-management.hotels.create', compact('id', 'routeName','model'));
    }
    public function descriptionStore(Request $request, $id){
        $this->validateDescriptionRequest($request);
        return $this->hotelManagementService->descriptionUpdate($request,$id);
    }
    public function imagesUploadIndex($id){
        $routeName = $this->routeName;
        $id = decrypt($id);
        return view('service-management.hotels.create', compact('id', 'routeName'));
    }
    public function imagesStore($id){
        $id = encrypt($id);
        return ['title' => 'success','message' => 'Next add Admin Descriptions', 'redirect' => route('hotels.description.create', ['id' => $id])];
    }
    public function changeStatus(Request $request)
    {
        if ($request->state) {
            return $this->hotelManagementService->changeState($request->hotel_id, $request->column, $request->state == 'active' ? 1 : 0);
        } else if ($request->approval) {
            $approve = 0;
            if ($request->approval == 'approved') {
                $approve = 1;
            } else if ($request->approval == 'block') {
                $approve = 2;
            }
            return $this->hotelManagementService->changeState($request->hotel_id, $request->column, $approve);
        }
    }

    public function amenitiesEdit(Request $request, $id)
    {
        $routeName = $this->routeName;
        $id = decrypt($id);
        $hotel = Hotel::where('id',$id)->firstOrFail();
        return view('service-management.hotels.edit', compact('id', 'routeName','hotel'));
    }

    public function amenitiesUpdate(Request $request, $id)
    {
        $message =  $this->hotelManagementService->amenitiesStore($request,$id);
        if(isset($message['redirect'])){
            $message['redirect'] = route('hotels.images.edit', $message['id']);
        }
        return $message;
    }

    public function descriptionEdit(Request $request, $id)
    {
        $routeName = $this->routeName;
        $id = decrypt($id);
        $model = Hotel::where('id',$id)->firstOrFail();
        return view('service-management.hotels.edit', compact('id', 'routeName','model'));
    }

    public function descriptionUpdate(Request $request, $id)
    {
        $this->validateDescriptionRequest($request);
        return $this->hotelManagementService->descriptionUpdate($request,$id);
    }

    public function imagesUploadEdit(Request $request, $id)
    {
        $routeName = $this->routeName;
        $id = decrypt($id);
        return view('service-management.hotels.edit', compact('id', 'routeName'));
    }

    public function imagesUpdate(Request $request, $id)
    {
        $id = encrypt($id);
        return ['title' => 'success','message' => 'Hotel images updated', 'redirect' => route('hotels.description.edit', ['id' => $id])];
    }
    // public function roomCreate($id){

    //     $routeName = $this->routeName;
    //     $id = decrypt($id);
    //     $hotel = Hotel::where('id',$id)->firstOrFail();
    //     return view('service-management.hotels.create', compact('id', 'routeName','hotel'));
    // }

    // public function roomStore(Request $request, $id){
    //     dd('ok store');
    // }
}
