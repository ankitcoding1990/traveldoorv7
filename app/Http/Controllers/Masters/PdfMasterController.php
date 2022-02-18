<?php

namespace App\Http\Controllers\Masters;

use App\Models\ItineraryPdf;
use Illuminate\Http\Request;
use App\Services\pdfMasterService;
use App\Http\Controllers\Controller;
use App\DataTables\PdfMasterDatatable;

class PdfMasterController extends Controller
{
    public $routeName;
    public function __construct(pdfMasterService $service)
    {
        $this->service = $service;
        $this->routeName = 'pdf_master.index';
    }

    public function index(PdfMasterDatatable $datatable)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)) {
            return $datatable->with(['routeName' => $routeName])->render('mains.masters.pdf_master.index',compact('routeName'));
        } else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName])->render('mains.masters.pdf_master.index',compact('routeName'));
        }
        return abort(403, 'You have no permission');

        // return $datatables->render('mains.masters.pdf_master.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mains.masters.pdf_master.create');
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
            'title' => 'required',
            'content_desciption' => 'required',
            'about_text' => 'required',
            'about_image' => 'image',
            'contact_image' =>'image',
        ]);
        $message = $this->service->store($request);
        session()->flash('status', $message);
        return redirect()->route('pdf_master.index');
    }

    public function changeState(Request $request)
    {
        $message = $this->service->statechanger($request->id);
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
        $pdf = ItineraryPdf::where('id',$id)->firstOrFail();
        return view('mains.masters.pdf_master.details',compact('pdf'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pdf = ItineraryPdf::where('id',$id)->firstOrFail();
        return view('mains.masters.pdf_master.create',compact('pdf'));
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
            'content_desciption' => 'required',
            'about_text' => 'required',
            'about_image' => 'image',
            'contact_image' =>'image',
        ]);
        $message = $this->service->store($request);
        session()->flash('status', $message);
        return redirect()->route('pdf_master.index');
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
