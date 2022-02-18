<?php
namespace App\Services;

use App\Models\Contact;
use App\Repositories\AgentManagementRepository;
use App\Repositories\SupplierManagementRepository;
use Hash;
class PasswordChangeService
{
    protected $SupplierManagementRepository;
    protected $agentManagementRepo;
    function __construct(SupplierManagementRepository $supplierManagementRepo,AgentManagementRepository $agentManagementRepo)
    {
        $this->supplierManagementRepo = $supplierManagementRepo;
        $this->agentManagementRepo    = $agentManagementRepo;
    }

    public function update($request,$id)
    {
        if($request->type == 'supplier') {
            $data   = $this->prepareData($request);
            $result = $this->supplierManagementRepo->update($data,$id);
            if($result) {
                return ['Password Changes Successfully!','success']; 
            } else {
                return ['Unable To Change Password!','error']; 
            }
        } else if($request->type == 'agent'){
            $data   = $this->prepareData($request);
            $result = $this->agentManagementRepo->update($data,$id);
            if($result) {
                return ['Password Changes Successfully!','success']; 
            } else {
                return ['Unable To Change Password!','error']; 
            }
        }  else {
            return ['Something Went Wrong!','error']; 
        }
    }

    public function prepareData($request)
    {
        $data['password']      = Hash::make($request->password_confirmation);
        $data['password_hint'] = $request->password_confirmation;
        return $data;
    }
    
}
