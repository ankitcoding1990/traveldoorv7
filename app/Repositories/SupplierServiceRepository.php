<?php
namespace App\Repositories;

use App\Models\Suppliers;
use App\Models\SupplierLog;
use App\Models\SupplierService;

class SupplierServiceRepository
{
  protected $model;
  function __construct(SupplierService $SupplierService)
  {
    $this->model = $SupplierService;
  }
  function store(Array $data){
    try {
      // dd($data);
      $result    = $this->model->updateOrCreate(['supplier_id' => $data['supplier_id'], 'service_id' => $data['service_id']],$data);
      if($result) {
        return ['status' => true, 'message' => 'Service Added', 'redirect' => '/suppliers', 'type' => 'success'];
      }
    } catch (\Exception $e) {
        return ['status' => false, 'message' => $e->getMessage(), 'type' => 'error'];
    }
  }
}