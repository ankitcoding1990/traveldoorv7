<?php

namespace App\Http\Controllers\Masters;

use App\Models\AcceptancePdfMaster;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AcceptancePDFService;

class AcceptancePdfController extends Controller
{

    public $routeName;
    public function __construct(AcceptancePDFService $AcceptancePDFService)
    {
        $this->routeName  = 'acceptance_master.index';
        $this->AcceptancePDFService = $AcceptancePDFService;
    }
    public function index()
    {
        $acceptance=AcceptancePdfMaster::latest()->first();
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)){
            return view('mains.masters.acceptancepdf.index',compact('acceptance','routeName'));
        } else if(auth()->user()->hasViewPermission($this->routeName)){
            return view('mains.masters.acceptancepdf.index',compact('acceptance','routeName'));
        }
        return abort(403, 'You have no permission');
        // $acceptance=AcceptancePdfMaster::latest()->first();
        // return view('mains.masters.acceptancepdf.index',compact('acceptance'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'acceptance_pdf_english' => 'required',
        ]);
        $message = $this->AcceptancePDFService->store($request);
        return response(['redirect' => route('acceptance_master.index'),'message' => $message[0],'type' => $message[1]],200);
    }
}
