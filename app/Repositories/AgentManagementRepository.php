<?php
namespace App\Repositories;

use App\Models\Agent;
use App\Models\AgentBankDetail;
use App\Models\AgentContact;
use App\Models\AgentService;

/**
 *
 AgentManagementRepository
 */
class AgentManagementRepository
{
  protected $agent, $agentBank, $agentContact, $agentService;
  function __construct(Agent $agent, AgentBankDetail $agentBank, AgentContact $agentContact, AgentService $agentService)
  {
    $this->agent = $agent;
    $this->agentBank = $agentBank;
    $this->agentContact = $agentContact;
    $this->agentService = $agentService;
  }
  function store($data){
    try {
    //dd($data);
      $agentData = $this->agent->create($data);
     
      if($agentData){
        $agent_data = $agentData->toArray();
        $agent_data['agent_operation_performed']  =  "INSERT";
        $agent_data['agent_id'] =  $agent_data['id'];
       
        return ['status' => true, 'title'=>'Agent Added', 'message' => 'Agent Added Successfully', 'redirect' => route('agent.login'), 'type' => 'success','data' => $agent_data];
    }
    } catch (\Exception $e) {
      dd($e->getMessage());
      return ['status' => false, 'title'=>'Error', 'message' => $e->getMessage(), 'type' => 'error'];
    }
  }
//   function storeBankDetail($data,$id = null){
   
//     try{
//       // dd($data, $id);
//         //$agentBank = $this->agentBank->create($data);      
//         $agentBank = $this->agentBank->updateOrCreate(['id' => $id], $data);      
//         if($agentBank){
//           //  $agentBankDetail = $agentBank->toArray();
//            // $agentBankDetail['agent_bank_details'] = "INSERT";
//             //$agentBankDetail['bank_id'] = $agentBankDetail['id'];
//             return response(['status' => true, 'title'=>'Success', 'message' => 'Agent Bank Added Successfully', 'type' => 'success'],200);
//         }
//     }catch(\Exception $e){
//         return response(['status' => false, 'title'=>'Error', 'message' => $e->getMessage(), 'type' => 'error'],200);
//     }
// }
// function storeContactDetail($data)
// {
//    try {
//        $agentContact = $this->agentContact->create($data);
//        if($agentContact){
//          //  $agentContactDetail = $agentContact->toArray();
//          //  $agentContactDetail['agent_contacts'] = "INSERT";
//            //$agentContactDetail['contact_id'] = $agentContactDetail['id'];
//            return response(['status' => true, 'title'=>'Contact Details Added', 'message' => 'Agent Contact Details Added Successfully', 'type' => 'success']);
//        }
//    } catch (\Throwable $e) {
//        return response(['status' => false, 'title'=>'Error', 'message' => $e->getMessage(), 'type' => 'error']);
//    }
// }
  function storeServices(Array $data, $id=null){
    try {
      $agentServices = $this->agentService->updateOrCreate(['id'=> $id],$data);
      if($agentServices) {
        return response(['status' => true, 'message' => 'Service Added', 'redirect' => '/agent', 'type' => 'success']);
      }
    } catch (\Exception $e) {
        return response(['status' => false, 'message' => $e->getMessage(), 'type' => 'error']);
    }
  }

  function update(Array $data, $id){
    //dd($id);
    try {
      $model = $this->agent->find($id);
    
      if($model){
        $model = $this->agent->where('id',$id)->update($data);
        
        if($model){
          return response(['status' => true, 'message' => 'Profile Updated',  'type' => 'success']);
        }
      }
      throw new \Exception("Model Not Found!", 1);
    } catch (\Exception $e) {
      return response(['status' => false, 'message' => $e->getMessage(), 'type' => 'error']);
    }
  }
  public function statechanger($id)
	{
    
		try{
			$return = array();
			$state = $this->agent->where('id',$id)->first();
			if($state->status == NULL){
				$this->agent->where('id',$id)->update(['status' => date('Y-m-d')]);
        
				$return['subject']   = 'Agent In-Activated Successfully.';
				$return['message'] = 'Hi '.$state->name.'. Your agent account has been De-Activated by Admin, Now you cannot access Your Services.';
			}
			else{
				$this->agent->where('id',$id)->update(['status' => NULL]);
        $return['subject']   = 'Agent Activated Successfully.';
				$return['message'] = 'Congratualtions '.$state->name.'. Your agent account has been activated Successfully, Now you can add Your Services.';
			}
			$return['type'] = 'success';
			$return['to']   = $state->email;
			$return['name'] = $state->name;
			return $return;
		}
		catch (\Exception $err){
			return 0;
		}
	}
}

 ?>
