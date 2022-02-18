<?php

namespace App\Services;

use App\Repositories\HotelTypeRepository;

class HotelTypeService {

    public function __construct(HotelTypeRepository $repo)
    {
        $this->repo = $repo;
    }
    public function store($request, $id = null)
    {
        $data = $request->only('hotel_type_name','hotel_type_created_by');
        $data['hotel_type_status'] = 1;
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
