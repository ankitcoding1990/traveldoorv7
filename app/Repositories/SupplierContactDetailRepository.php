<?php
namespace App\Repositories;

use App\Models\SupplierContactDetail;

class SupplierContactDetailRepository
{
  protected $model;
  function __construct(SupplierContactDetail $SupplierContactDetail)
  {
    $this->model = $SupplierContactDetail;
  }
  function store(Array $data){
    try {
        $insertData = $this->model->create($data); 
          if($insertData) {
            return ['status' => true, 'message' => 'Contact Added', 'redirect' => '/suppliers', 'type' => 'success','data' => $insertData];
          }
    } catch (\Exception $e) {
        return ['status' => false, 'message' => $e->getMessage(), 'type' => 'error'];
    }
  }
}