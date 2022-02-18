<?php

namespace App\Http\Controllers\EnquiryManagement;

use App\Models\Enquiries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\EnquiryManagementService;

class EnquiriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(EnquiryManagementService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        return view('mains.enquiry_management.enquiries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getEnquiriesTable(Request $request)
    {
        $data = $request->all();
        $enquiries = $this->service->getEnquires($data);
        $html = view('mains.enquiry_management.enquiries.enquiry_table',compact('enquiries'));

        return response($html->render());
    }
    public function getSpecialOffersTable(Request $request)
    {
        $data = $request->all();
        $specialOffers = $this->service->getSpecialOffers($data);
        $html = view('mains.enquiry_management.enquiries.special_offer_table',compact('specialOffers'));

        return response($html->render());
    }
    public function getTourTable(Request $request)
    {
        $data = $request->all();
        $tours = $this->service->getTours($data);
        $html = view('mains.enquiry_management.enquiries.tour_table',compact('tours'));

        return response($html->render());
    }

    public function setAssignedTo(Request $request)
    {
       $message = $this->service->setAssignedTo($request);
       return$message;
    }
    public function create()
    {
        return view('mains.enquiry_management.enquiries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
}
