<?php
namespace App\Repositories;

use Exception;
use App\Models\Vehicles;

class VehicleRespository{

    public function __construct(Vehicles $model)
    {
        $this->model = $model;
    }
    public function update($data)
    {
        try {
            $this->model->where('id',$data['id'])->update($data);
            return 1;
        }
        catch (Exception $err) {
            return 0;
        }
    }

    public function insert($data)
    {
        try{
            $this->model->create($data);
            return 1;
        }
        catch (Exception $err){
            return 0;
        }
    }
    public function delete($id)
    {
        try{
            $this->model->where('id',$id)->delete();
            return 1;
        }
        catch(Exception $err){
            return 0;
        }
    }
    public function statechanger($id)
    {
        try{
            $state = $this->model->where('id',$id)->first();
            if($state->vehicle_status){
                $this->model->where('id',$id)->update(['vehicle_status' => 0]);
            }
            else{
                $this->model->where('id',$id)->update(['vehicle_status' => 1]);
            }
            return 1;
        }
        catch (Exception $err){
            return 0;
        }
    }
}
