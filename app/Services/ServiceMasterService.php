<?php

namespace App\Services;

use App\Models\Services;
use App\Repositories\ServiceMasterRepository;
use App\Traits\MyUpload;

class ServiceMasterService {
    use MyUpload;
    function __construct(ServiceMasterRepository $repo){
        $this->repo = $repo;
    }

    public function store($request)
    {
        $data = $request->only('service_name','country_id','city_id','service_type','price_per_pax','price_per_service','service_description','service_created_by');
        if($request->delimage){
            $data['service_image'] = null;
        }
        if($request->hasFile('service_image')){
            $file = $request->file('service_image');
            $path = Services::$imagesPath;
            $filename = self::singleFile($file, $path, 'service-master');
            $data['service_image'] = $filename;
        }
        $data['service_status'] = 1;
        if(!empty($request->id)){
            $data['id'] = $request->id;
            $res = $this->repo->update($data);
            if($res){
                return ['Service Got Updated', 'success'];
            }
            else{
                return ['Cannot Update the Service', 'error'];
            }
        }
        else{
            $res = $this->repo->insert($data);
            if($res){
                return ['New Service Got Added', 'success'];
            }
            else{
                return ['Cannot Add New Service','error'];
            }
        }
    }

    public function delete($id)
    {
        $res = $this->repo->delete($id);
        if($res){
            return ['Service Deleted Successfully', 'success'];
        }
        else{
            return ['Cannot Delete Service', 'error'];
        }
    }
}
