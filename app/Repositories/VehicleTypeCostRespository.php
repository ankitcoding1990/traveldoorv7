<?php

namespace App\Repositories;
use App\Models\VehicleType;
use App\Models\VehicleWiseCost;
use Exception;

class VehicleTypeCostRespository{

    public function __construct(VehicleWiseCost $model)
    {
        $this->model = $model;
    }

    public function insert($data)
    {
        try{
            $this->model->create($data);
            return ['title' => 'Suucess', 'message' => 'New vehicle cost added!', 'type' => 'success','table' => 'vehicletypecostdatatables-table'];
        }catch (Exception $err){
            return ['title' => 'Failed', 'message' => 'Failed! due to '.$err->getMessage(),'type' => 'error'];
        }

    }
    public function update($data, $id)
    {
        try{
            $this->model->where('id',$id)->update($data);
            return ['title' => 'Suucess', 'message' => 'New vehicle cost added!', 'type' => 'success', 'redirect' => route('vehicles_type_cost.index')];
        }catch (Exception $err){
            return ['title' => 'Failed', 'message' => 'Failed! due to '.$err->getMessage(),'type' => 'error'];
        }
    }

    public function delete($id)
    {
        try {
            $this->model->where('id',$id)->delete();
            return ['title' => 'success','subject' => 'Cost deleted', 'type' => 'success'];
        } catch (\Throwable $err) {
            return ['title' => 'Failed','subject' => 'Failed! due to'.$err->getMessage(),'type' => 'error'];
        }
    }
}
