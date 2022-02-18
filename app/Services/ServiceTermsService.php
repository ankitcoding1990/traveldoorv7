<?php

namespace App\Services;

use App\Repositories\ServiceTermsRepository;

class ServiceTermsService{
    public function __construct(ServiceTermsRepository $repo)
    {
        $this->repo = $repo ;
    }

    public function store($request)
    {
        $data = $request->only('service_id','terms_conditions','cancel_policy','confirm_msg');
        if(!empty($request->id)){
            $data['id'] = $request->id;
            $res = $this->repo->update($data);
            if($res){
                return ['Service Terms Got Updated','success'];
            }
            else{
                return ['Fail To Update Service Terms','error'];
            }
        }
        else{
            $res = $this->repo->insert($data);
            if($res){
                return ['New Service Terms Added','success'];
            }
            else{
                return ['Fail To Add New Service Terms'];
            }
        }
    }
}
