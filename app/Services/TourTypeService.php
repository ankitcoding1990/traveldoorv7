<?php

namespace App\Services;

use App\Repositories\TourTypeRepository;

class TourTypeService{

    public function __construct(TourTypeRepository $repo)
    {
        $this->repo = $repo;
    }
    public function store($request)
    {
        $data = $request->only('tour_type_name','tour_type_created_by');
        $data['tour_type_status'] = 1;
        if(!empty($request->id)){
            $data['id'] = $request->id;
            $res = $this->repo->update($data);
            if($res){
                return ['Tour Type Updated Successfully!', 'success'];
            }
            else{
                return ['Fail To Update The Tour Type!', 'error'];
            }
        }
        else{
            $res = $this->repo->insert($data);
            if($res){
                return ['New Tour Type Added SuccussFully!', 'success'];
            }
            else{
                return ['Fail To Add New Tour Type! ', 'error'];
            }
        }
    }

    public function delete($id)
    {
        $res = $this->repo->delete($id);
        if($res){
            return ['Tour Type Deleted Successfully', 'success'];
        }
        else{
            return ['Fail To Delete Tour Type', 'error'];
        }
    }
}
