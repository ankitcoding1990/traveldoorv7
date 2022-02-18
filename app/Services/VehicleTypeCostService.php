<?php

namespace App\Services;

use App\Repositories\VehicleTypeCostRespository;
use phpDocumentor\Reflection\Types\Float_;

class VehicleTypeCostService{
    public function __construct(vehicleTypeCostRespository $repo)
    {
        $this->repo = $repo;
    }

    public function store($request, $id = null)
    {
        $data = $request->only('vehicle_type_id','vehicle_type_cost','vehicle_cost_created_by');
        $data['vehicle_type_cost'] = number_format((float)$data['vehicle_type_cost'],2);
        if($id != null){
            return $this->repo->update($data, $id);
        }
        return $this->repo->insert($data);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
