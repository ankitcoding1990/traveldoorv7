<?php
namespace App\Services;

use Hash;
use App\Models\Supplier;
use App\Traits\MyUpload;
use App\Services\ContactsService;
use App\Repositories\ContactsRepository;
use App\Repositories\SupplierServiceRepository;
use App\Repositories\SupplierBankDetailRepository;
use App\Repositories\SupplierManagementRepository;

class SupplierManagementService
{
    use MyUpload;

    protected $supplierManagementRepo;
    protected $SupplierServiceRepository;
    protected $SupplierBankDetailRepository;
    protected $ContactsRepository;

    function __construct(SupplierManagementRepository $supplierManagementRepo,SupplierServiceRepository $SupplierServiceRepository
    ,SupplierBankDetailRepository $SupplierBankDetailRepository,ContactsRepository $ContactsRepository)
    {
        $this->supplierManagementRepo          = $supplierManagementRepo;
        $this->SupplierServiceRepository       = $SupplierServiceRepository;
        $this->SupplierBankDetailRepository    = $SupplierBankDetailRepository;
        $this->ContactsRepository              = $ContactsRepository;
    }

    function store($request){
        $email_id = $request->email;
        $contact_number = $request->company_contact;
        $check_supplier = Supplier::where('email', $email_id)->orWhere('company_contact', $contact_number)->get();
        if (count($check_supplier) > 0) {
            return ['status' => true, 'message' => 'Supplier Already Exists', 'type' => 'warning'];
        }else{
            $this->prepareSupplierData($request);
            $data = $request->only('name', 
            'company_name','email', 
            'password','password_hint', 
            'company_contact', 'company_fax', 
            'user_ref_id', 'address', 'country_id', 
            'city_id', 'corporate_reg_no', 'corporate_desc', 
            'skype_id', 'fuel_info', 'operating_hrs_from', 'operating_hrs_to', 'operating_weekdays',
            'certificate_corp','logo', 'opr_currency', 'opr_countries',
            'blackout_dates', 
            'supplier_created_by','supplier_created_by_role','supplier_status');
            $result = $this->supplierManagementRepo->store($data);
            if($result['status']) {
                $bankData                      = $request->bank_details;
                $contactData                   = $request->contact_persons;
                $serviceData                   = $request->service_type;
                $supplierID                    = $result['data']['id'];
                $contactData['supplier_id']    = $supplierID;
                $bankData['supplier_id']       = $supplierID;
                $bankInsert    = $this->SupplierBankDetailRepository->store($bankData);

                $contactInsert = $this->ContactsRepository->store($contactData);

                foreach ($serviceData as $value) {
                    $insertData['service_id']  = $value;
                    $insertData['supplier_id'] = $supplierID;
                    $serviceInsert = $this->SupplierServiceRepository->store($insertData);
                }
                if($serviceInsert) {
                    return ['type' => 'success','subject' => 'Supplier Registration.','message' => 'Congratulation on Successfull Registration as a Supplier in Traveldoor Community.'
                        ,'route' => route('supplier.login'),'to' => $request->email,'username' => $request->name,'password' => $request->password_hint];
                } else {
                    return ['type' => 'error','message' => 'Unable Registered Supplier!','route' => ''];
                }
            }
        }
    }

    public function update($request,$id,$isAdmin = false)
    {
        $this->prepareSupplierData($request);
        $data = $request->only('name', 
            'company_name','email', 
            'password','password_hint', 
            'company_contact', 'company_fax', 
            'user_ref_id', 'address', 'country_id', 
            'city_id', 'corporate_reg_no', 'corporate_desc', 
            'skype_id', 'fuel_info', 'operating_hrs_from', 'operating_hrs_to', 'operating_weekdays',
            'certificate_corp','logo', 'opr_currency', 'opr_countries',
            'blackout_dates', 
            'supplier_created_by','supplier_created_by_role','supplier_status');
        $result = $this->supplierManagementRepo->update($data,$id);
        if($isAdmin) {
            $result['redirect'] = route('suppliers.index');
        }
        return $result;
    }

    function prepareSupplierData($request){
       $certificateImageName  = NULL;
       $logoImageName         = NULL;
        if ($request->hasFile('supplier_certificate_corp')) {
            $certificateImageName = $this->singleFile($request->file('supplier_certificate_corp'), 'assets/uploads/supplier_certificates/');
        } else {
            $certificateImageName = $request->supplier_certificate_corp_old ?? null;
        }
        if ($request->hasFile('supplier_logo')) {
            $logoImageName = $this->singleFile($request->file('supplier_logo'), 'assets/uploads/supplier_logos/');
        } else {
            $logoImageName = $request->supplier_logo_old ?? null;
        }
        
        $supplieConatctDetails['name']  =  $request->contact_name ?? null;
        $supplieConatctDetails['phone']  =  $request->contact_number ?? null;
        $supplieConatctDetails['whatsapp']  =  $request->contact_whatsapp ?? null;
        $supplieConatctDetails['email']  =  $request->contact_email ?? null;
        $supplierBankDetails                = $request->only('bank_account_number','bank_name','bank_ifsc','bank_iban','bank_currency_id');
        
        $supplierBankDetails['type']        = 'supplier';
        $supplieConatctDetails['type']      = 'supplier';
      
        if(!$request->has('password')) {
            $supplier_password_hint = "12345";
        } else {
            $supplier_password_hint = $request->password;
        }
        
        $request->request->add([
            'password_hint'    =>  $supplier_password_hint,
            'password'         =>  \Hash::make($supplier_password_hint),
            'bank_details'     => $supplierBankDetails,
            'contact_persons'  => $supplieConatctDetails,
            'certificate_corp' => $certificateImageName,
            'logo'             => $logoImageName,
            'service_type'     => $request->service_type,
        ]);
        
    }

    public function statechanger($id)
    {
        $res = $this->supplierManagementRepo->statechanger($id);
        if($res){
            $res['route']   = route('supplier.login');
            return $res;
        }
        else{
            return ['Fail To Change State','error'];
        }
    }

    function activeOrInactive($request, $id){
        $action_perform = $request->get('action_perform');
        // dd($action_perform);
        $data_log = Supplier::where('supplier_id',$id)->first()->toArray();

        $message = 'Status could not change!';
        if ($action_perform == "active") {
            $data['supplier_status'] = 1;
            $message = 'Selected Supplier has been activated.';
        }else if($action_perform == "inactive") {
            $data['supplier_status'] = 0;
            $message = 'Selected Supplier has been inactivated.';
        }else{
            return ['status' => false, 'message' => 'Status could not change!'];
        }
        $data_log['supplier_operation_performed']  =  $action_perform;
        // dd($data);
        $result = $this->supplierManagementRepo->update($data,$id, $data_log);
        if ($result['status']) {
            $result['message'] = $message;
            return $result;
        }
        return $result;

    }

    function passwordChange($request){
        $supplier_id = $request->get('supplier_id');
        $supplier_new_password = $request->get('supplier_new_password');
        $supplier_confirm_password = $request->get('supplier_confirm_password');
        if ($supplier_new_password == $supplier_confirm_password) {
            $password_original = $supplier_new_password;
            $password_secure = Hash::make($password_original);

            $change_password_updation = Supplier::where('supplier_id', $supplier_id)->update(["supplier_password" => $password_secure, "supplier_password_hint" => $password_original]);

            if ($change_password_updation) {
                echo "success";
            } else {
                echo "fail";
            }
        } else {
            echo "mismatch";
        }
    }
}