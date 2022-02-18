<?php

namespace App\Services;

use App\Repositories\SubAmenitiesRespository;

class SubAmenitiesService{
    public function __construct(SubAmenitiesRespository $repo)
    {
        $this->repo = $repo;
    }

    public function store($request, $id = null)
    {
        $data = $request->only('sub_amenities_created_by','amenities_id','sub_amenities_name');
        $data['sub_amenities_status'] = 1;
        if($id != null){
            return $this->repo->update($data, $id);
        }
        return $this->repo->insert($data);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    public function statechanger($id, $status)
    {
        return $this->repo->statechanger($id, $status);
    }
}
