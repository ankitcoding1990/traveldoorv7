<?php

namespace App\Services;

use App\Repositories\VehicleRespository;

class VehicleService {

    public function __construct(VehicleRespository $repo)
    {
        $this->repo = $repo;
    }

    public function store($request)
    {
        $data = $request->only('vehicle_created_by','vehicle_type_id','vehicle_name','vehicle_created_role');
        $data['vehicle_status'] = 1;
        if(!empty($request->id)){
            $data['id'] = $request->id;
            $res = $this->repo->update($data);
            if($res){
                return ['Vehicle Got Updated', 'success'];
            }
            else{
                return ['Can\'t Update the Vehicle', 'error'];
            }
        }
        else{
            $res = $this->repo->insert($data);
            if($res){
                return ['New Vehicle Got Added', 'success'];
            }
            else{
                return ['Can\'t Add New Vehicle','error'];
            }
        }
    }

    public function delete($id)
    {
        $res = $this->repo->delete($id);
        if($res){
            return ['Vehicle Deleted Successfully', 'success'];
        }
        else{
            return ['Can\'t Delete Vehicle', 'error'];
        }
    }

    public function statechanger($id)
    {
        $res = $this->repo->statechanger($id);
        if($res){
            return ['Status Changed successfully!','success'];
        }
        else{
            return ['Fail To Change Status','error'];
        }
    }
}
