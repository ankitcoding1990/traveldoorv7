<?php
namespace App\Repositories;

use App\Models\VehicleType;
use Exception;

class VehicleTypeRepository{
    public function __construct(VehicleType $model)
    {
        $this->model = $model;
    }
    public function update($data, $id)
    {
        try{
            $this->model->where('id', $id)->update($data);
            return ['title' => 'success', 'message' => 'vehicle type has been updated', 'type' => 'success', 'redirect' => route('vehicles_types.index')];
        }
        catch (Exception $err){
            return ['title' => 'Failed', 'message' => 'Failed! due to '.$err->getMessage(), 'type' => 'error'];
        }
    }

    public function insert($data)
    {
        try{
            $this->model->create($data);
            return ['title' => 'success', 'message' => 'vehicle type has been updated', 'type' => 'success', 'table' => 'vehicaldatatables-table'];
        }
        catch (Exception $err){
            return ['title' => 'Failed', 'message' => 'Failed! due to '.$err->getMessage(), 'type' => 'error'];
        }
    }

    public function delete($id)
    {
        try{
            $this->model->where('id',$id)->delete();
            return ['title' => 'success', 'subject' => 'vehicle type deleted!', 'type' => 'success'];
        }
        catch (Exception $err){
            return ['title' => 'Failed', 'subject' => 'failed! due to'. $err->getMessage(), 'type' => 'error'];
        }

    }

    public function ChangeState($id , $state)
    {
        try {
            $bool = $state == 'active' ? '1' : '0';
            $this->model->where('id',$id)->update(['vehicle_type_status' => $bool]);
            return ['title' => 'success', 'subject' => 'vehicle type'.$state.'d', 'type' => 'success'];
        } catch (\Exception $err) {
            return ['title' => 'Failed', 'subject' => 'Failed! due to'. $err->getMessage(),'type' => 'error'];
        }
    }
}
