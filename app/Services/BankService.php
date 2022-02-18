<?php
namespace App\Services;

use App\Repositories\SupplierBankDetailRepository;

class BankService{
    protected $SupplierBankDetailRepository;
    public function __construct(SupplierBankDetailRepository $SupplierBankDetailRepository)
    {
        $this->SupplierBankDetailRepository = $SupplierBankDetailRepository;
    }

    public function storeBankDetails($request,$id = null,$vendor = null,$type = null)
    {
        $supplierBankDetails                = $request->only('bank_account_number','bank_name','bank_ifsc','bank_iban','bank_currency_id');
        if (auth()->guard('supplier')->user()) {
            $supplierBankDetails['supplier_id'] = auth()->guard('supplier')->user()->id;
            $supplierBankDetails['type']        = 'supplier';
            $redirect                           = 'profile';
        } else if(auth()->guard('agent')->user()) {
            $supplierBankDetails['agent_id']    = auth()->guard('agent')->user()->id;
            $supplierBankDetails['type']        = 'agent';
            $redirect                           = '';
        } else {
            $redirect                           = '';
        }
        if($vendor) {
            $supplierBankDetails['supplier_id'] = $vendor;
            $supplierBankDetails['type']        = $type;
        }
        if ($id) {
            $bankInsert    = $this->SupplierBankDetailRepository->store($supplierBankDetails,$id);
        } else {
            $bankInsert    = $this->SupplierBankDetailRepository->store($supplierBankDetails);
        }
        
        if($bankInsert['status']) {
            return ['redirect' => $redirect];
        }
    }

    public function deleteBankDetails($id)
    {
        if($id) {
            $bankDelete    = $this->SupplierBankDetailRepository->delete($id);
            if($bankDelete){
                return ['Bank Deleted Successfully!','success',true];
            }
            else{
                return ['Fail To Delete Bank.','error',true];
            }
        }  else{
            return ['Fail To Delete Bank.','error',true];
        }
    }
}