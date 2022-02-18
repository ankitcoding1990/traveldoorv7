<?php
namespace App\Repositories;

use App\Models\Supplier;
use App\Models\SupplierLog;

class SupplierManagementRepository
{
  protected $supplier;
  function __construct(Supplier $supplier)
  {
    $this->supplier = $supplier;
  }
  function store(Array $data){
    try {
      
        $supplier =  $this->supplier->create($data);
        if($supplier){
            $supplier_log                                  = $supplier->toArray();
            $supplier_log['supplier_operation_performed']  =  "INSERT";
            $supplier_log['supplier_id']                   =  $supplier['id'];
            return ['status' => true, 'message' => 'Supplier Added', 'redirect' => '/suppliers', 'type' => 'success','data' => $supplier_log];
        }
    } catch (\Exception $e) {
        return ['status' => false, 'message' => $e->getMessage(), 'type' => 'error'];
    }
  }
  function update(Array $data, $id, $data_log = null){
    try {
        $supplier =  $this->supplier->where('id', $id)->get();
        if ($supplier) {
            $supp = $this->supplier->where('id', $id)->update($data);
            if($supp){
                if ($data_log) {
                  $log = SupplierLog::create($data_log);
                }
                return ['status' => true, 'message' => 'Record Updated', 'redirect' => '/suppliers', 'type' => 'success'];
            }
        }
        throw new \Exception("Supplier ID not found!", 1);
    } catch (\Exception $e) {
        return ['status' => false, 'message' => $e->getMessage(), 'type' => 'error'];
    }
  }

  public function statechanger($id)
	{
		try{
			$return = array();
			$state = $this->supplier->where('id',$id)->first();
			if($state->status == NULL){
				$this->supplier->where('id',$id)->update(['status' => date('Y-m-d')]);
				$return['subject']   = 'Supplier In-Activated Successfully.';
				$return['message'] = 'Hi '.$state->name.'. Your supplier account has been De-Activated by Admin, Now you cannot access Your Services.';
			}
			else{
				$this->supplier->where('id',$id)->update(['status' => NULL]);
        $return['subject']   = 'Supplier Activated Successfully.';
				$return['message'] = 'Congratualtions '.$state->name.'. Your supplier account has been activated Successfully, Now you can add Your Services.';
			}
			$return['type'] = 'success';
			$return['to']   = $state->email;
			$return['name'] = $state->name;
			return $return;
		}
		catch (Exception $err){
			return 0;
		}
	}
}
