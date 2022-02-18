<?php

namespace App\Http\Controllers\Masters;

use App\Models\EnquiryType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\EnquiryTypeService;
use App\DataTables\EnquiryTypeDatatables;

class EnquiryTypeController extends Controller
{
    public $routeName;

    public function __construct(EnquiryTypeService $service)
    {
        $this->service = $service;
        $this->routeName  = 'enquiry_type.index';
    }

    public function index(EnquiryTypeDatatables $datatable)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)){
            return $datatable->with(['routeName' => $routeName])->render('mains.masters.Enquiry_type.index',compact('routeName'));
        }else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName])->render('mains.masters.Enquiry_type.index',compact('routeName'));
        }
        return abort(403, 'You have no permission');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Changestate(Request $request)
    {
        return $this->service->Changestate($request->id, $request->state);
    }
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
        $request->validate(['enquiry_type_name' => 'required|unique:enquiry_type,enquiry_type_name']);
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
        $enquiry_type = EnquiryType::where('id', $id)->firstOrFail();
        return view('mains.masters.enquiry_type.index', compact('enquiry_type','routeName'));
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
        $request->validate(['enquiry_type_name' => "required|unique:enquiry_type,enquiry_type_name"]);
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
        $message = $this->service->delete($id);
        return $message;
    }
}
