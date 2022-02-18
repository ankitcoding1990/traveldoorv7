<?php

namespace Modules\Supplier\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\ActivityServicesService;
use App\DataTables\ActivityServiceDatatable;
use App\Http\Requests\ActivityRequest;
use App\Models\ActivityBooking;
use App\Models\ActivityPricing;
use App\Services\ActivityBookingService;
use App\Services\ActivityPricingService;
use Illuminate\Contracts\Support\Renderable;

class ActivityServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __construct(ActivityServicesService $basicService,
        ActivityPricingService $pricingService,
        ActivityBookingService $bookingService)
    {
        $this->basicService = $basicService;
        $this->pricingService = $pricingService;
        $this->bookingService = $bookingService;
        $this->routeName = "activity.index";
    }
    public function index(ActivityServiceDatatable $datatable)
    {
        $routeName = $this->routeName;
        return $datatable->with(['user_id' => auth()->guard('supplier')->user()->id, 'isSupplier' => true , 'routeName' => $routeName, 'filter' => 'undrafted'])->render('supplier::pages.service-managements.activity.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function draftedIndex(ActivityServiceDatatable $datatable)
    {
        $routeName = $this->routeName;
        return $datatable->with(['user_id' => auth()->guard('supplier')->user()->id, 'isSupplier' => true , 'routeName' => $routeName, 'filter' => 'drafted'])->render('supplier::pages.service-managements.activity.index');
    }
    public function create()
    {
        return view('supplier::pages.service-managements.activity.create');
    }

    public function pricingCreate($id)
    {
        $id = decrypt($id);
        $age_group = Activity::where('id',$id)->first()->age_groups;
        return view('supplier::pages.service-managements.activity.create',compact('id','age_group'));
    }

    public function bookingCreate($id)
    {
        $id = decrypt($id);
        $fromDate = Activity::where('id',$id)->first()->valid_from;
        $toDate = Activity::where('id',$id)->first()->valid_to;
        return view('supplier::pages.service-managements.activity.create',compact('id','fromDate','toDate'));
    }

    public function imagesCreate($id)
    {
        $id = decrypt($id);
        return view('supplier::pages.service-managements.activity.create',compact('id'));
    }

    public function descriptionCreate($id)
    {
        $id = decrypt($id);
        return view('supplier::pages.service-managements.activity.create',compact('id'));
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ActivityRequest $request)
    {
        $message = $this->basicService->store($request);
        if($message['redirect'] != null)
            $message['redirect'] = route('supplier.activity.prices.create',[$message['id']]);
        return $message;
    }

    public function pricingStore(Request $request)
    {
        $message = $this->pricingService->store($request);
        if($message['redirect'] != null)
            $message['redirect'] = route('supplier.activity.booking.create',[$message['id']]);
        return $message;
    }

    public function bookingStore(Request $request)
    {
        $message = $this->bookingService->store($request);
        if($message['redirect'] != null)
            $message['redirect'] = route('supplier.activity.images.create',[$message['id']]);
        return $message;
    }

    public function imagesStore(Request $request)
    {
        $id = encrypt($request->reference);
        return ['title' => 'success','message' => 'Activity Images stored', 'redirect' => route('supplier.activity.description.create',[$id])];
    }

    public function descriptionStore(Request $request)
    {
        $message = $this->basicService->DescriptionStore($request);
        if($message['redirect'] != null)
            $message['redirect'] = route($this->routeName);
        return $message;
    }
    public function show($id)
    {
        return view('supplier::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $activity = Activity::find($id)->first();
        return view('supplier::pages.service-managements.activity.edit',compact('id','activity'));
    }

    public function pricingEdit($id)
    {
        $id = decrypt($id);
        $age_group = Activity::where('id',$id)->first()->age_groups;
        $pricings  = ActivityPricing::where('activity_id',$id)->get();
        return view('supplier::pages.service-managements.activity.edit',compact('id','pricings','age_group'));
    }
    public function bookingEdit($id)
    {
        $id = decrypt($id);
        $fromDate = Activity::where('id',$id)->first()->valid_from;
        $toDate = Activity::where('id',$id)->first()->valid_to;
        $bookings = ActivityBooking::where('activity_id',$id)->get();
        return view('supplier::pages.service-managements.activity.edit',compact('id','bookings','fromDate','toDate'));
    }
    public function imagesEdit($id)
    {
        $id = decrypt($id);
        return view('supplier::pages.service-managements.activity.edit',compact('id'));
    }
    public function descriptionEdit($id)
    {
        $id = decrypt($id);
        $description = Activity::find($id)->first();
        return view('supplier::pages.service-managements.activity.edit',compact('id','description'));
    }
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $message = $this->basicService->store($request, $id);
        if($message['redirect'] != null)
            $message['redirect'] = route('supplier.activity.prices.edit',[$message['id']]);
        return $message;
    }

    public function pricingUpdate(Request $request, $id)
    {
        $message = $this->pricingService->store($request, $id);
        if($message['redirect'] != null)
            $message['redirect'] = route('supplier.activity.booking.edit',$message['id']);
        return $message;
    }

    public function bookingUpdate(Request $request, $id)
    {
        $message = $this->bookingService->store($request, $id);
        if($message['redirect'] != null)
            $message['redirect'] = route('supplier.activity.images.edit',$message['id']);
        return $message;
    }

    public function imageUpdate(Request $request)
    {
        $id = encrypt($request->reference);
        return ['title' => 'success','message' => 'Activity Images stored', 'redirect' => route('supplier.activity.description.edit',$id)];
    }
    public function descriptionUpdate(Request $request, $id)
    {
        $message = $this->basicService->DescriptionStore($request);
        if($message['redirect'] != null)
            $message['redirect'] = route('activity.index');
        return $message;
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
