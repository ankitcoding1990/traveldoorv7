<?php
namespace App\Services;

use Mail;
use Session;
use App\User;
use App\Models\Cities;
use App\Models\Hotels;
use App\Models\Countries;
use App\Models\Supplier;
use App\Models\Transport;
use App\Models\Activity;
use App\Models\Agents_log;
use App\Models\UserRight;
use App\Models\AgentWallet;

use App\Models\Agent;
use App\Traits\MyUpload;
use App\Mail\SendMailable;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\Hash;
use App\Repositories\ContactsRepository;
use App\Repositories\ServiceRepositories;
use App\Repositories\AgentManagementRepository;
use App\Repositories\SupplierBankDetailRepository;

/**
 *
 AgentManagementService
 */
class AgentManagementService
{
    use MyUpload;
  protected $agentManagementRepo, $SupplierBankDetailRepository, $ContactsRepository;
  function __construct(AgentManagementRepository $agentManagementRepo, SupplierBankDetailRepository $SupplierBankDetailRepository, ContactsRepository $ContactsRepository, ServiceRepositories $ServiceRepository)
  {
    $this->agentManagementRepo = $agentManagementRepo;
    $this->SupplierBankDetailRepository = $SupplierBankDetailRepository;
    $this->ContactsRepository = $ContactsRepository;
    $this->ServiceRepository = $ServiceRepository;
  }
  // store
  function store($request){
        $check_agent=Agent::where('email',$request->get('email'))->orWhere('company_contact',$request->get('company_contact'))->get();
        if(count($check_agent)>0){
            return response(['status' => false, 'title' => 'Already Exist!', 'message' => 'Agent with this email or contact already exists']);
        }
        else{
            $this->prepareData($request);
            $data = $request->only('name', 'email', 'password', 'password_hint', 'company_name', 'company_email', 'company_contact', 'company_fax', 'user_ref_id', 'address', 'country_id', 'city_id', 'corporate_reg_no', 'corporate_desc', 'skype_id', 'operating_hrs_from', 'operating_hrs_to', 'operating_weekdays', 'certificate_corp', 'agent_logo', 'operate_country_id', 'opr_currency', 'created_user_id', 'status');

            $result = $this->agentManagementRepo->store($data);
            if($result['status']){
                $agentID = $result['data']['agent_id'];
                /* Agent Bank Details */
                $bankData =  $request->only('bank_account_number','bank_name','bank_ifsc','bank_iban','bank_currency_id');
                /* Agent Contact Detail */
                $contactData = [
                    'name'=> $request->contact_name,
                    'phone' => $request->contact_number,
                    'whatsapp' => $request->contact_whatsapp,
                    'email' => $request->contact_email
                ];

                $contactData['agent_id'] = $agentID;
                $contactData['type'] = 'agent';
                /* Agent Selected Services */
                $servicesData             = $request->service_ids;
                $agentServicesMarkup = [];
                foreach($request->markup as $key => $value){
                    if($value != null){
                        array_push($agentServicesMarkup,$value);
                    }
                }

                /* Agent Selected Services End*/
                $bankInsert    = $this->SupplierBankDetailRepository->store($bankData);
                $contactInsert    = $this->ContactsRepository->store($contactData);
                $agentDataPrepare         = array();
                foreach ($servicesData as $key => $value) {
                    $agentDataPrepare['service_id']  =  $value;
                    $agentDataPrepare['agent_id']    =  $agentID;
                    $agentDataPrepare['type']    =  'agent';
                    $agentDataPrepare['agent_markup']=  $agentServicesMarkup[$key];
                    $servicesInsert    = $this->ServiceRepository->store($agentDataPrepare);
                }
                return $result;
            }
     }
  }
  function update($request,$id){
     // dd($request->all());
    $this->prepareData($request);
    $data = $request->only('name', 'email', 'password', 'password_hint', 'company_name', 'company_email', 'company_contact', 'company_fax', 'address', 'country_id', 'city_id', 'corporate_reg_no', 'corporate_desc', 'skype_id', 'operating_hrs_from', 'operating_hrs_to', 'operating_weekdays', 'certificate_corp', 'agent_logo', 'operate_country_id', 'opr_currency',);
    $result = $this->agentManagementRepo->update($data, $id);
    return $result;
}

  function prepareData($request){
        $dir = 'assets/uploads/';
        $certificate_corp = NULL;
        $agent_logo       = NULL;
        // dd($request->input());
        if($request->has('agent_certificate_file')) {
            $certificate_corp = $this->singleFile($request->file('agent_certificate_file'),$dir.'agent_certificates/');
        }
        else {
            $certificate_corp = $request->agent_certificate_file_old ?? null;
        }

        if($request->has('agent_logo_file')) {
            $agent_logo = $this->singleFile($request->file('agent_logo_file'),$dir.'agent_logos/');
        } else {
            $agent_logo = $request->agent_logo_file_old ?? null;
        }

        $serviceType=$request->service_type ?? null;
        $agentServices = $request->service_ids ?? null;
        $agentServicesData = array();
        if($agentServices) {
            foreach($agentServices as $key => $serviceSelected){
                $agentServicesData[$key] = $serviceSelected ?? null;
            }
        }
        $created_by =  $request->created_user_id ?? 0;
        $opr_currency = $request->opr_currency ?? null;
        $operating_weekdays = $request->operating_weekdays ?? null;
        $password_hint = $request->password ?? null;
        $password = Hash::make($request->password);
        $request->request->add([
            'password_hint'=>$password_hint,
            'password'           => $password,
            'certificate_corp'   => $certificate_corp,
            'agent_logo'         => $agent_logo,
            //'agent_bank_details' => $agentBankDetails,
            //'contact_persons'    => $agentConatctDetails,
            'operating_weekdays' => $operating_weekdays,
            'opr_currency'       => $opr_currency,
            'service_ids'         => $agentServicesData,
            'created_user_id'    => $created_by,
        ]);

    }
    public function statechanger($id)
    {
        $res = $this->agentManagementRepo->statechanger($id);
        if($res){
            $res['route']   = route('agent.login');
            return $res;
        }
        else{
            return ['Fail To Change State','error'];
        }
    }
    function activeOrInactive($request, $id){
        $action_perform = $request->get('action_perform');
        dd($action_perform);
        $data_log = Agent::where('agent_id',$id)->first()->toArray();
        $message = 'Status could not change!';
        if ($action_perform == "active") {
            $data['status'] = 1;
            $message = 'Selected Agent has been activated.';
        }else if($action_perform == "inactive") {
            $data['status'] = 0;
            $message = 'Selected Agent has been inactivated.';
        }else{
            return ['status' => false, 'message' => 'Status could not change!'];
        }
        $data_log['agent_operation_performed']  =  $action_perform;
        // dd($data);
        $result = $this->agentManagementRepo->update($data,$id, $data_log);
        if ($result['status']) {
            $result['message'] = $message;
            return $result;
        }
        return $result;
    }   
}
