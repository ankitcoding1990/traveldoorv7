<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Currency;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Services\BankService;
use App\Http\Controllers\Controller;

class BankController extends Controller
{

    protected $BankService;
    public function __construct(BankService $BankService)
    {
        $this->BankService = $BankService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->guard('supplier')->user()) {
            $vendor   = auth()->guard('supplier')->user();
        } else if (auth()->guard('agent')->user()) {
            $vendor   = auth()->guard('agent')->user();
        }
        
        $currency = Currency::get();
        $html  = view('common.banks.form',compact('currency','vendor'));
        return response(['html' => $html->render()], 200);    
    }

    public function createBankForm(Request $request)
    {
        $id       = decrypt($request->id);
        $currency = Currency::get();
        if($id) {
            $type   = $request->type;
            $vendor = Supplier::where('id',$id)->firstOrFail();
            $html   = view('common.banks.form',compact('currency','vendor','type'));
            return response(['html' => $html->render()], 200);    
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id   = $request->id; 
        $type = $request->type; 
        $request->validate([
            'bank_account_number'=>'required',
            'bank_name' => 'required',
            'bank_ifsc' => 'required',
            'bank_iban' => 'required',
            'bank_currency_id' => 'required'
        ]);
        $result = $this->BankService->storeBankDetails($request,null,$id,$type);
        if($result) {
            return response(['message'=>'Bank Added Succesfully.','type' => 'success', 'redirect' => $result['redirect']]);
        } else {
            return response(['message'=>'Unable to Add Bank.','type' => 'error', 'redirect' => $result['redirect']]);
        }
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
        $currency = Currency::get();
        if($id) {
            $bank       = Bank::find($id);
            $isRegister = false;
            $html       = view('common.banks.form',compact('bank','currency'))->render();
            return response(['status' => 'ok' , 'html' => $html]);
        }
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
            'bank_account_number'=>'required',
            'bank_name' => 'required',
            'bank_ifsc' => 'required',
            'bank_iban' => 'required',
            'bank_currency_id' => 'required'
        ]);
        $this->BankService->storeBankDetails($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(isset($id)) {
            $message = $this->BankService->deleteBankDetails($id);
            return $message;
        } else {
            return ['Fail To Delete Bank.','error',true];
        }
    }
}
