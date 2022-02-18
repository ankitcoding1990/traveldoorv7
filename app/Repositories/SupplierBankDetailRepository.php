<?php
namespace App\Repositories;

use App\Models\Bank;

class SupplierBankDetailRepository
{
  protected $model;
  function __construct(Bank $Bank)
  {
    $this->model = $Bank;
  }
  function store(Array $data, $id=null){
    try {
        $result = $this->model->updateOrCreate(['id'=>$id],$data);
        if($result) {
          return ['status' => true, 'message' => 'Bank Added', 'redirect' => '/suppliers', 'type' => 'success','data' => $result];
        }
    } catch (\Exception $e) {
        return ['status' => false, 'message' => $e->getMessage(), 'type' => 'error'];
    }
  }

  function delete($id)
  {
    try{
      $this->model->where('id',$id)->delete();
      return 1;
    }
    catch (Exception $eer){
        return 0;
    }
  }
}