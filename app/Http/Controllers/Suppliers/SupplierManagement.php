<?php

namespace App\Http\Controllers\Suppliers;

use App\User;
use App\Models\Cities;
use App\Models\States;
use App\Models\Currency;
use App\Models\Supplier;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\DataTables\SupplierDatatables;
use App\Http\Requests\SupplierValidation;
use App\Services\SupplierManagementService;

class SupplierManagement extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $routeName;
    public function __construct(SupplierManagementService $supplierManagementService)
    {
        $this->supplierManagementService = $supplierManagementService;
        $this->routeName  = 'suppliers.index';
    }

    public function index(SupplierDatatables $datatable)
    {
        $get_suppliers = Supplier::get();
        $countries     = Countries::get();
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)){
            return $datatable->with(['routeName' => $routeName])->render('mains.suppliers.index',compact('routeName','get_suppliers','countries'));
        }else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName])->render('mains.suppliers.index',compact('routeName','get_suppliers','countries'));
        }
        return abort(403, 'You have no permission');
    }

    public function create(Request $request)
    {
        return view('mains.suppliers.create');
    }

    public function store(Request $request)
    {
        $this->ValidateRequest($request);
        $message = $this->supplierManagementService->store($request);
        if($message['type'] == 'success') {
            event(new \App\Events\SendMail($message));
            return $message;
        } else {
            return $message;
        }
    }

    public function show($id)
    {
        $id       = decrypt($id);
        $supplier = Supplier::where('id',$id)->firstOrFail();
        if($supplier) {
            return view('mains.suppliers.profile.profile',compact('id','supplier'));
        }
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $supplier  = Supplier::where('id',$id)->firstOrFail();
        return view('mains.suppliers.create',compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $this->ValidateRequest($request);
        $return = $this->supplierManagementService->update($request,$id,true);
        return $return;
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

    public function getcities(Request $request)
    {
        $states = States::where('country_id',$request->country)->get();
        $list  = array();
        $cities = array();
        foreach($states as $key => $state){
            $list[] = Cities::where('state_id',$state->id)->pluck('name','id');
        }
        foreach($list as $key => $value){
            foreach($value as $k => $v){
                $cities[$k] = [$v];
            }
        }
        return $cities;
    }

    public function switchState(Request $request)
    {
        $message = $this->supplierManagementService->statechanger($request->id);
        if($message['type'] == 'success') {
            event(new \App\Events\SendMail($message));
            return $message;
        } else {
            return $message;
        }
    }

    public function ValidateRequest($request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'company_contact' => 'required',
            'company_fax' => '',
            'address' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'operating_weekdays' => 'required',
            'operating_weekdays.*' => 'required',
            'supplier_certificate_corp' => '',
            'supplier_logo' => '',
            'opr_currency' => 'required|array',
            'opr_countries' => 'required|array',
        ]);
    }

    public function changePasswordIndex($id)
    {
        $id = decrypt($id);
        if($id) {
            return view('mains.suppliers.password',compact('id'));
        }
    }

    public function bankIndex($id)
    {
        $id = decrypt($id);
        if($id) {
            $supplier = Supplier::where('id',$id)->firstOrFail();
            return view('mains.suppliers.profile.banks',compact('supplier','id'));
        }
    }

    public function serviceIndex($id)
    {
        $id = decrypt($id);
        if($id) {
            $supplier = Supplier::where('id',$id)->firstOrFail();
            return view('mains.suppliers.profile.services',compact('supplier','id'));
        }
    }

    public function contactPersonIndex($id)
    {
        $id = decrypt($id);
        if($id) {
            $supplier = Supplier::where('id',$id)->firstOrFail();
            return view('mains.suppliers.profile.contactpersons',compact('supplier','id'));
        }
    }
}
