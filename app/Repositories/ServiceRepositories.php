<?php
namespace App\Repositories;


use App\Models\AgentService;

class ServiceRepositories
{
  protected $model;
  function __construct(AgentService $Services)
  {
    $this->model = $Services;
  }
  function store(Array $data, $id=null){
    //   /dd($data);
    try {
      $result    = $this->model->updateOrCreate(['id'=>$id],$data);
      if($result) {
        return ['status' => true, 'message' => 'Service Added', 'redirect' => '/agent', 'type' => 'success'];
      }
    } catch (\Exception $e) {
        return ['status' => false, 'message' => $e->getMessage(), 'type' => 'error'];
    }
  }
}