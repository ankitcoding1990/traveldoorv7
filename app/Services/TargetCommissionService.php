<?php

namespace App\Services;

use App\Repositories\TargetCommissionRepository;

class TargetCommissionService{

    public function __construct(TargetCommissionRepository $repo)
    {
        $this->repo = $repo;
    }

    public function store($request)
    {
        $data = $request->only('st_amount','st_commission_per','st_created_by');
        $data['st_status'] = 1;
        if(!empty($request->id)){
            $data['id'] = $request->id;
            $res = $this->repo->update($data);
            if($res){
                return ['Target Commission Got Updated', 'success'];
            }
            else{
                return ['Can\'t Update the Target Commission', 'error'];
            }
        }
        else{
            $res = $this->repo->insert($data);
            if($res){
                return ['New Target Commission Got Added', 'success'];
            }
            else{
                return ['Can\'t Add New Target Commission','error'];
            }
        }
    }

    public function delete($id)
    {
        $res = $this->repo->delete($id);
        if($res){
            return ['Target Commission Deleted Successfully', 'success'];
        }
        else{
            return ['Can\'t Delete Target Commission', 'error'];
        }
    }
}
