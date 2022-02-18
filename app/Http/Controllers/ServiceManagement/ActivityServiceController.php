<?php

namespace App\Http\Controllers\ServiceManagement;

use App\Activities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityRequest;
use App\Services\ActivityServicesService;
use App\DataTables\ActivityServiceDatatable;
use App\Models\Activity;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\States;
use App\Models\Supplier;

class ActivityServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ActivityServicesService $service)
    {
        $this->service = $service;
        $this->routeName = 'activities.index';
    }
    public function index(ActivityServiceDatatable $datatable)
    {
        $routeName = $this->routeName;
        $activity = Activity::where('draft_status',1)->get();
        if(auth()->user()->hasViewPermission($this->routeName,1)) {
            return $datatable->with(['routeName' => $routeName, 'filter' => 'undrafted'])->render('service-management.activities.index',compact('routeName'));
        } else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName, 'filter' => 'undrafted'])->render('service-management.activities.index',compact('routeName','activity'));
        }
        return abort(403, 'You have no permission');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function drafted(ActivityServiceDatatable $datatable)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)) {
            return $datatable->with(['routeName' => $routeName, 'filter' => 'drafted'])->render('service-management.activities.index',compact('routeName'));
        } else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName, 'filter' => 'drafted'])->render('service-management.activities.index',compact('routeName'));
        }
        return abort(403, 'You have no permission');
    }
    public function create(Request $request)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasAddPermission($this->routeName,1)){
            return view('service-management.activities.create',compact('routeName'));
        }
        else if(auth()->user()->hasAddPermission($this->routeName)){
            return view('service-management.activities.create',compact('routeName'));
        }
        return abort(403, 'You have no permission');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ImageUploadIndex($id)
    {
        $id = decrypt($id);
        $routeName = $this->routeName;
        return view('service-management.activities.create',compact('routeName','id'));
    }

    public function ImageEditIndex($id)
    {
        $id = decrypt($id);
        $routeName = $this->routeName;
        return view('service-management.activities.edit',compact('id','routeName'));
    }

    public function AcitivityImagesUpdate(Request $request)
    {
        $id = encrypt($request->id);
        return ['title' => 'success','message' => 'Activity Images stored', 'redirect' => route('activity.description.edit',['id' => $id])];
    }

    public function descriptionCreate($id)
    {
        $routeName = $this->routeName;
        $id = decrypt($id);
        return view('service-management.activities.create',compact('id','routeName'));

    }

    public function descriptionStore(Request $request)
    {
        $message = $this->service->DescriptionStore($request);
        return $message;
    }
    public function AcitivityImages(Request $request)
    {
        $id = encrypt($request->id);
        return ['title' => 'success','message' => 'Activity Images stored', 'redirect' => route('activity.description.create',['id' => $id])];
    }

    public function descriptionEdit($id)
    {
        $routeName = $this->routeName;
        $id = decrypt($id);
        $description = Activity::where('id',$id)->get()->first();
        return view('service-management.activities.edit',compact('id','routeName','description'));

    }

    public function descriptionUpdate(Request $request)
    {
        $message = $this->service->DescriptionStore($request);
        return $message;
    }
    public function changeStatus(Request $request)
    {
        return $this->service->changeState($request->activity_id, $request->column, $request->state == 'active'? 1 : 0 );
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
        $model = Activity::where('id',$id)->first();
        return view('service-management.activities.view',compact('model'));
    }
    public function SupplierCountries(Request $request)
    {
        $supplierCountries = Supplier::where('id',$request->supplier_id)->first();
    $countries = Countries::whereIn('id',$supplierCountries->opr_countries)->get();
       return $countries->pluck('country_name','id');
    }

    public function store(ActivityRequest $request)
    {
        $message = $this->service->store($request);
        return $message;
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
        $activity = Activity::where('id',$id)->firstOrFail();
        return view('service-management.activities.edit',compact('routeName','activity'));
    }
    public function pricingEdit($id)
    {

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

    public function cloneActivity($id)
    {
        $message = $this->service->clone($id);
        return $message;
    }
}
