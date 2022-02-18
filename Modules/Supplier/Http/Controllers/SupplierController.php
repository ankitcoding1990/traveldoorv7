<?php

namespace Modules\Supplier\Http\Controllers;

use App\Models\Currency;
use App\Models\Countries;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\SupplierManagementService;
use Illuminate\Contracts\Support\Renderable;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public $SupplierManagementService;
    public function __construct(SupplierManagementService $SupplierManagementService)
    {
        $this->SupplierManagementService = $SupplierManagementService;
    }

    public function index()
    {
        $supplier   = auth()->guard('supplier')->user();
        if($supplier) {
            $supplierCountries  = Countries::whereIn('id',$supplier->opr_countries)->get();
            $supplierCurrencies = Currency::whereIn('id',$supplier->opr_currency);
            return view('supplier::dashboard.profile1',compact('supplier','supplierCountries','supplierCurrencies'));
        }
    }

    public function indexDashboard()
    {
        $supplier   = auth()->guard('supplier')->user();
        if($supplier) {
            return view('supplier::home',compact('supplier'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
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
        $supplier = Supplier::findOrFail(decrypt($id));
        if($supplier) {
            return view('supplier::dashboard.editprofile',compact('supplier'));
        }

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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

    public function profileIndex()
    {
        // $supplier   = auth()->guard('supplier')->user();
        // if($supplier) {
        //     $supplierCountries  = Countries::whereIn('id',$supplier->opr_countries)->get();
        //     $supplierCurrencies = Currency::whereIn('id',$supplier->opr_currency);
        //     return view('supplier::dashboard.profile1',compact('supplier','supplierCountries','supplierCurrencies'));
        // }
    }

    public function bankStore(Request $req)
    {
        $req->validate([
            'bank_details' => 'required|array',
            'bank_details.*.*' => 'required',
        ],[
            'bank_details.account_number.*.required' => 'The Account Number field is required.',
            'bank_details.name.*.required'           => 'The Name field is required.',
            'bank_details.swift.*.required'          => 'The Swift field is required.',
            'bank_details.iban.*.required'           => 'The IBAN field is required.',
            'bank_details.currency.*.required'       => 'The Currency field is required.',
        ]);
        $result = $this->SupplierManagementService->storeBankDetails($req);
        if($result) {
            return response(['status' => 'ok']);
        }
    }
}
