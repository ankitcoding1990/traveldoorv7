<?php

namespace Modules\Supplier\Http\Controllers;

use App\Models\Currency;
use App\Models\Countries;
use App\Models\Supplier;
use App\Models\SupplierBankDetail;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use App\Repositories\SupplierBankDetailRepository;
use App\Services\BankService;

class SupplierBankController extends Controller
{
    public $SupplierBankDetail;
    protected $BankService;
    public function __construct(SupplierBankDetailRepository $SupplierBankDetailRepository,BankService $BankService)
    {
        $this->BankService = $BankService;
        $this->SupplierBankDetailRepository = $SupplierBankDetailRepository;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $supplier   = auth()->guard('supplier')->user();
        if($supplier) {
            $supplierCountries  = Countries::whereIn('id',$supplier->opr_countries)->get();
            $supplierCurrencies = Currency::whereIn('id',$supplier->opr_currency);
            return view('supplier::dashboard.bank',compact('supplier','supplierCountries','supplierCurrencies'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
    
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {

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
