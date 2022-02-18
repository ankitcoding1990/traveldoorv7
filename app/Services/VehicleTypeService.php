<?php
namespace App\Services;

use App\Models\VehicleType;
use App\Traits\MyUpload;
use App\Repositories\VehicleTypeRepository;

class VehicleTypeService {

    use MyUpload;

    public function __construct(VehicleTypeRepository $repo)
    {
        $this->repo = $repo;
    }

    public function store($request, $id = null)
    {
        $data = $request->only('vehicle_type_name','vehicle_type_min','vehicle_type_max','vehicle_type_created_by');
        if($request->hasFile('vehicle_type_image')){
            $file = $request->file('vehicle_type_image');
            $path = VehicleType::$imagesPath;
            $filename = self::singleFile($file, $path, 'vehicle_types');
            $data['vehicle_type_image'] = $filename;
        }
        if($id != null){
            return $this->repo->update($data, $id);
        }
        return $this->repo->insert($data);

    }

    public function delete($id)
    {
        return $res = $this->repo->delete($id);

    }

    public function ChangeState($request)
    {
        return $this->repo->ChangeState($request->id,$request->state);
    }
}
