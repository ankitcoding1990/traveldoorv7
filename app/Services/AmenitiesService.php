<?php
namespace App\Services;

use App\Repositories\AmenitiesRepository;

class AmenitiesService{
    public function __construct(AmenitiesRepository $repo)
    {
        $this->repo = $repo;
    }
    public function store($request, $id = null)
    {

        $data = $request->only('amenities_name','amenities_created_by');
        if($id != null){
            return $this->repo->update($data, $id);
        }
        return $this->repo->insert($data);
    }

    public function delete($id)
    {
        $res = $this->repo->delete($id);
        if($res){
            return ['Amenities Deleted successfully', 'success'];
        }
        else{
            return ['Amenities Fail To Delete', 'error'];
        }
    }

    public function statechanger($id, $status)
    {
        return $this->repo->statechanger($id, $status);

    }
}
